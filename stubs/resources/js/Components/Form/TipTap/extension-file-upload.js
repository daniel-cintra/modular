import { Extension } from '@tiptap/core'

const FileUpload = Extension.create({
    name: 'fileUpload',

    addOptions: {
        allowedFileTypes: 'image/*',
        maximumFileSize: 5, // Default to 5 MB
        onBeforeUpload: null,
        onUploadCompleted: null,
        onError: null,
        fileUploadUrl: null
    },

    addCommands() {
        const isFileTypeAllowed = (fileType) => {
            const allowedTypes = this.options.allowedFileTypes.split(',')
            return allowedTypes.some((type) =>
                fileType.includes(type.replace('*', ''))
            )
        }

        return {
            uploadFile:
                () =>
                ({ editor }) => {
                    const input = document.createElement('input')
                    input.type = 'file'
                    input.accept = this.options.allowedFileTypes
                    input.onchange = async () => {
                        // Marked as async
                        const file = input.files[0]
                        const maxSizeInBytes =
                            this.options.maximumFileSize * 1024 * 1024
                        if (
                            file &&
                            file.size <= maxSizeInBytes &&
                            isFileTypeAllowed(file.type)
                        ) {
                            const formData = new FormData()
                            formData.append('file', file)

                            const request = { formData }
                            if (this.options.onBeforeUpload) {
                                this.options.onBeforeUpload(request)
                            }

                            try {
                                const response = await fetch(
                                    this.options.fileUploadUrl,
                                    {
                                        method: 'POST',
                                        body: formData
                                    }
                                )

                                if (!response.ok) {
                                    throw new Error(
                                        `Upload failed: ${response.statusText}`
                                    )
                                }

                                const data = await response.json()
                                this.options.onUploadCompleted(
                                    {
                                        target: {
                                            response: JSON.stringify(data)
                                        }
                                    },
                                    editor
                                )
                            } catch (error) {
                                if (this.options.onError) {
                                    this.options.onError(error.message)
                                }
                            }
                        } else {
                            if (this.options.onError) {
                                this.options.onError(
                                    'File is too large or not an allowed file type'
                                )
                            } else {
                                alert(
                                    'File is too large or not an allowed file type'
                                )
                            }
                        }
                    }
                    input.click()
                    return true
                }
        }
    }
})

export default FileUpload
