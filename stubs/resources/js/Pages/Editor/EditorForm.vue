<template>
    <h1 class="my-4">Rich Editor Example</h1>

    <AppFormErrors class="mb-4" />

    <AppTipTap
        v-model="form.$1"
        :class="{
            'app-tip-tap-error': errorsFields.includes('description')
        }"
        :image-upload-path="route('editor.uploadEditorImage')"
    />

    <div class="my-3">
        <FileUpload
            mode="basic"
            accept="image/*"
            :custom-upload="true"
            :max-file-size="2048"
            :auto="false"
            choose-label="Browse"
            :class="{
                'border-skin-error': errorsFields.includes('my_logo')
            }"
            @select="(e) => (form.my_logo = e.files[0])"
        />

        <p class="mt-2 mb-4">
            <a
                v-if="form.my_logo"
                href="#"
                class="text-skin-secondary underline"
                @click.prevent="() => (form.my_logo = null)"
                >remove logo</a
            >
        </p>
    </div>

    <div class="my-4">
        <Button label="Salvar" class="mt-1" @click="submitForm" />
    </div>
</template>

<script setup>
import { onMounted } from 'vue'
import { useForm } from '@inertiajs/vue3'
import useFormErrors from '@/Composables/useFormErrors'

const props = defineProps({
    editorContent: {
        type: String,
        default: ''
    }
})

const form = useForm({
    description: props.editorContent,
    my_file: ''
})

const submitForm = () => {
    form.post(route('editor.store'))
}

// onMounted(() => {
//     form.description = props.editorContent
// })

const { errorsFields } = useFormErrors()
</script>
