<template>
    <AppSectionHeader title="Banners" :bread-crumb="breadCrumb">
    </AppSectionHeader>

    <Card class="mx-8">
        <template #title> {{ title }} </template>
        <template #content>
            <AppFormErrors class="mb-4" />
            <form class="p-fluid w-2/4">
                <div class="field my-3">
                    <label for="title">Title</label>
                    <InputText
                        id="title"
                        v-model="form.title"
                        type="text"
                        :class="{
                            'p-invalid': errorsFields.includes('title')
                        }"
                    />
                </div>

                <div class="py-4">
                    <FileUpload
                        mode="basic"
                        accept="image/*"
                        :custom-upload="true"
                        :max-file-size="2048000"
                        :auto="false"
                        choose-label="Browse"
                        :class="{
                            'border-skin-error':
                                errorsFields.includes('filename')
                        }"
                        @select="(e) => (form.filename = e.files[0])"
                    />

                    <p class="mt-2 mb-4">
                        <a
                            v-if="form.filename"
                            href="#"
                            class="text-skin-secondary underline"
                            @click.prevent="() => (form.filename = null)"
                            >remove file</a
                        >
                    </p>
                </div>

                <div class="field">
                    <label for="link">Link</label>
                    <InputText
                        id="link"
                        v-model="form.link"
                        type="text"
                        :class="{ 'p-invalid': errorsFields.includes('link') }"
                    />
                </div>

                <div class="mt-6 flex items-center">
                    <Checkbox
                        v-model="form.external_link"
                        input-id="external_link"
                        :binary="true"
                    />
                    <label for="external_link" class="ml-2"
                        >External Link</label
                    >
                </div>
            </form>
        </template>
        <template #footer>
            <Button label="Save" class="mt-1" @click="submitForm" />
        </template>
    </Card>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

import useTitle from '@/Composables/useTitle'
import useFormContext from '@/Composables/useFormContext'
import useFormErrors from '@/Composables/useFormErrors'

const props = defineProps({
    banner: {
        type: Object,
        default: null
    }
})

const breadCrumb = [
    { label: 'Home', href: route('dashboard.index') },
    { label: 'Sections', href: route('modularBannerSection.index') },
    { label: 'Banner', last: true }
]

const { title } = useTitle('Banner')

const form = useForm({
    section_id: props.banner
        ? props.banner.section_id
        : route().params.sectionId,
    title: props.banner ? props.banner.title : '',
    filename: props.banner ? props.banner.filename : '',
    link: props.banner ? props.banner.link : '',
    external_link: props.banner ? props.banner.external_link : false
})

const { isCreate } = useFormContext()

const submitForm = () => {
    if (isCreate.value) {
        form.post(route('modularBanner.store'))
    } else {
        form.transform((data) => ({
            ...data,
            _method: 'PUT'
        })).post(route('modularBanner.update', props.banner.id))
    }
}

const { errorsFields } = useFormErrors()
</script>
