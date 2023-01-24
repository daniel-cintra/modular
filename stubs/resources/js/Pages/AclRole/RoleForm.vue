<template>
    <AppSectionHeader title="Roles" :bread-crumb="breadCrumb">
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
    role: {
        type: Object,
        default: null
    }
})

const breadCrumb = [
    { label: 'Home', href: route('dashboard.index') },
    { label: 'Roles', href: route('aclRole.index') },
    { label: 'Role', last: true }
]

const { title } = useTitle('Role')

const form = useForm({
    name: props.role ? props.role.name : ''
})

const { isCreate } = useFormContext()

const submitForm = () => {
    if (isCreate.value) {
        form.post(route('aclRole.store'))
    } else {
        form.put(route('aclRole.update', props.role.id))
    }
}

const { errorsFields } = useFormErrors()
</script>
