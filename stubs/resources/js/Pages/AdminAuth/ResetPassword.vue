<template>
    <AppAuthShell>
        <AppAuthLogo />

        <Card class="space-y-4 p-6">
            <template #title> Password Reset </template>
            <template #subtitle>
                Fill the form below to reset your password.
            </template>

            <template #content>
                <AppFormErrors class="mb-4" />

                <form>
                    <div>
                        <label for="email">Email</label>
                        <InputText
                            id="email"
                            v-model="form.email"
                            type="text"
                            class="w-full"
                            :class="{
                                'p-invalid': errorsFields.includes('email')
                            }"
                        />
                    </div>

                    <div class="mt-6">
                        <label for="email">Password</label>
                        <Password
                            id="password"
                            v-model="form.password"
                            toggle-mask
                            :feedback="true"
                            class="w-full"
                            input-class="w-full"
                            :class="{
                                'p-invalid': errorsFields.includes('password')
                            }"
                        />
                    </div>

                    <div class="mt-6">
                        <label for="email">Password Confirmation</label>
                        <Password
                            id="password"
                            v-model="form.password_confirmation"
                            toggle-mask
                            :feedback="true"
                            class="w-full"
                            input-class="w-full"
                            :class="{
                                'p-invalid': errorsFields.includes(
                                    'password_confirmation'
                                )
                            }"
                        />
                    </div>
                </form>
            </template>

            <template #footer>
                <Button label="Save" class="my-4" @click="submitForm" />
            </template>
        </Card>
    </AppAuthShell>
</template>

<script>
import GuestLayout from '@/Layouts/GuestLayout.vue'

export default {
    layout: GuestLayout
}
</script>

<script setup>
import { useForm } from '@inertiajs/vue3'
import useFormErrors from '@/Composables/useFormErrors'

const props = defineProps({
    email: {
        type: String,
        required: true
    },
    token: {
        type: String,
        required: true
    }
})

const form = useForm({
    email: props.email,
    token: props.token,
    password: '',
    password_confirmation: ''
})

function submitForm() {
    form.post(route('adminAuth.resetPassword'))
}

const { errorsFields } = useFormErrors()
</script>
