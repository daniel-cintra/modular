<template>
    <AppSectionHeader title="Permissions" :bread-crumb="breadCrumb">
    </AppSectionHeader>

    <Card class="mx-8">
        <template #title> {{ title }} </template>
        <template #content>
            <AppFormErrors class="mb-4" />
            <form class="p-fluid w-2/4" @submit.prevent="submitForm">
                <div class="field">
                    <label for="name">Name</label>
                    <InputText
                        id="name"
                        v-model="form.name"
                        type="text"
                        :class="{ 'p-invalid': errorsFields.includes('name') }"
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
    permission: {
        type: Object,
        default: null
    }
})

const breadCrumb = [
    { label: 'Home', href: route('dashboard.index') },
    { label: 'Permissions', href: route('aclPermission.index') },
    { label: 'Permission', last: true }
]

const { title } = useTitle('Permission')

const form = useForm({
    name: props.permission ? props.permission.name : ''
})

const { isCreate } = useFormContext()

const submitForm = () => {
    if (isCreate.value) {
        form.post(route('aclPermission.store'))
    } else {
        form.put(route('aclPermission.update', props.permission.id))
    }
}

const { errorsFields } = useFormErrors()
</script>
