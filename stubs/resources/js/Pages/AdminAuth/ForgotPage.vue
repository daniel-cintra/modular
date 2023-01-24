<template>
    <AppAuthShell>
        <AppAuthLogo />

        <Card class="space-y-4 p-6">
            <template #title> Forgot your password? </template>
            <template #subtitle>
                Enter your email to reset your password.
            </template>

            <template #content>
                <AppFormErrors class="mb-4" />

                <form>
                    <div>
                        <label for="email">Your Email</label>
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
                </form>
            </template>

            <template #footer>
                <Button label="Send" class="my-4" @click="submitForm" />
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

const form = useForm({
    email: 'king.theresia@example.com'
})

function submitForm() {
    form.post(route('adminAuth.sendResetLinkEmail'))
}

const { errorsFields } = useFormErrors()
</script>
