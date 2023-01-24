<template>
    <AppSectionHeader title="Sections" :bread-crumb="breadCrumb">
    </AppSectionHeader>

    <Card class="mx-8">
        <template #title> {{ title }} </template>
        <template #content>
            <AppFormErrors class="mb-4" />
            <form class="p-fluid w-2/4">
                <div>
                    <label for="name">Name</label>
                    <InputText
                        id="name"
                        v-model="form.name"
                        type="text"
                        :class="{ 'p-invalid': errorsFields.includes('name') }"
                    />
                </div>

                <div class="field my-3">
                    <label for="img_width">Image Width</label>
                    <InputText
                        id="img_width"
                        v-model="form.img_width"
                        type="text"
                        :class="{
                            'p-invalid': errorsFields.includes('img_width')
                        }"
                    />
                </div>

                <div class="field my-3">
                    <label for="img_height">Image Height</label>
                    <InputText
                        id="img_height"
                        v-model="form.img_height"
                        type="text"
                        :class="{
                            'p-invalid': errorsFields.includes('img_height')
                        }"
                    />
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
    section: {
        type: Object,
        default: null
    }
})

const breadCrumb = [
    { label: 'Home', href: route('dashboard.index') },
    { label: 'Sections', href: route('modularBannerSection.index') },
    { label: 'Section', last: true }
]

const { title } = useTitle('Section')

const form = useForm({
    name: props.section ? props.section.name : '',
    img_width: props.section ? props.section.img_width : '',
    img_height: props.section ? props.section.img_height : ''
})

const { isCreate } = useFormContext()

const submitForm = () => {
    if (isCreate.value) {
        form.post(route('modularBannerSection.store'))
    } else {
        form.put(route('modularBannerSection.update', props.section.id))
    }
}

const { errorsFields } = useFormErrors()
</script>
