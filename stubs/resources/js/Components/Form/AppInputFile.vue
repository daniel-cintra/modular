<template>
    <div
        class="flex flex-col items-center space-y-4 rounded-lg border-2 border-dashed border-skin-neutral-6 p-4"
    >
        <input
            ref="fileInputRef"
            type="file"
            :accept="acceptedFormats"
            hidden
            @change="handleFileChange"
            @cancel="cancelFileChange"
        />

        <div class="flex flex-row space-x-3">
            <AppButton class="btn btn-primary" @click="triggerFileInput">
                <span v-if="!isLoading">Upload File</span>

                <i v-if="isLoading" class="ri-loader-line animate-spin"></i>
            </AppButton>

            <AppButton
                v-if="showRemoveFileButton && (file || imagePreview)"
                class="btn btn-destructive"
                @click="removeFile"
            >
                Remove File
            </AppButton>
        </div>

        <div v-if="file" class="text-center text-sm">
            <p>
                <strong class="text-skin-neutral-12">File Name:</strong>
                {{ file.name }}
            </p>
            <p>
                <strong class="text-skin-neutral-12">File Size:</strong>
                {{ file.size }} bytes
            </p>
        </div>
        <div v-if="imagePreview" class="flex w-full justify-center">
            <img
                :src="imagePreview"
                alt="image preview"
                class="h-auto max-w-full rounded shadow-md"
            />
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const props = defineProps({
    imagePreviewUrl: {
        type: [String, null],
        default: null
    },
    showRemoveFileButton: {
        type: Boolean,
        default: true
    }
})

onMounted(() => {
    if (props.imagePreviewUrl) {
        imagePreview.value = props.imagePreviewUrl
        emit('update:modelValue', null)
    }
})

const file = ref(null)
const imagePreview = ref(null)
const acceptedFormats = 'image/*'
const fileInputRef = ref(null)

const isLoading = ref(false)

const emit = defineEmits(['update:modelValue', 'remove-file'])

const triggerFileInput = () => {
    if (isLoading.value === true) {
        return
    } else {
        isLoading.value = true
    }

    fileInputRef.value.click()
}

const removeFile = () => {
    file.value = null
    imagePreview.value = null

    isLoading.value = false

    emit('update:modelValue', null)

    if (props.imagePreviewUrl) {
        emit('remove-file', true)
        return
    }
}

const handleFileChange = (event) => {
    const uploadedFile = event.target.files[0]

    emit('update:modelValue', uploadedFile)

    if (!uploadedFile) {
        isLoading.value = false
        return
    }

    file.value = uploadedFile

    // console.log(file.value)
    if (file.value) {
        const reader = new FileReader()
        reader.onload = (e) => {
            imagePreview.value = e.target.result
        }
        reader.readAsDataURL(file.value)
    }

    isLoading.value = false

    //prevents errors if the same file is uploaded twice
    event.target.value = null
}

const cancelFileChange = () => {
    isLoading.value = false
}
</script>
