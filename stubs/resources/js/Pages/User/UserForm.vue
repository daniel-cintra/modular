<template>
    <AppSectionHeader title="Users" :bread-crumb="breadCrumb">
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

                <div class="mt-6">
                    <label for="email">Email</label>
                    <InputText
                        id="email"
                        v-model="form.email"
                        type="text"
                        :class="{ 'p-invalid': errorsFields.includes('email') }"
                    />
                </div>

                <div class="mt-6">
                    <label for="email">Password</label>
                    <Password
                        id="password"
                        v-model="form.password"
                        toggle-mask
                        :feedback="true"
                        :class="{
                            'p-invalid': errorsFields.includes('password')
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
    user: {
        type: Object,
        default: null
    }
})

const breadCrumb = [
    { label: 'Home', href: route('dashboard.index') },
    { label: 'Users', href: route('user.index') },
    { label: 'Users', last: true }
]

const { title } = useTitle('User')

const form = useForm({
    name: props.user ? props.user.name : '',
    email: props.user ? props.user.email : '',
    password: props.user ? props.user.password : ''
})

const { isCreate } = useFormContext()

const submitForm = () => {
    if (isCreate.value) {
        form.post(route('user.store'))
    } else {
        form.put(route('user.update', props.user.id))
    }
}

const { errorsFields } = useFormErrors()
</script>

<!-- <style scoped>
.p-card::v-deep(.p-card-footer) {
  padding-top: 0;
}
</style> -->
