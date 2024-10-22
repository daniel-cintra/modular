<template>
    <Head title="Forgot Password"></Head>
    <AppAuthShell>
        <AppAuthLogo />

        <AppCard class="w-80 space-y-2 bg-skin-neutral-2">
            <template #title>
                <h3 class="px-2 py-3 text-lg font-semibold tracking-tight">
                    {{ __('Forgot your password?') }}
                </h3>
            </template>

            <template #description>
                <h2 class="px-2 text-sm leading-relaxed">
                    {{ __('Enter your email to reset your password.') }}
                </h2>
            </template>

            <template #content>
                <AppFormErrors class="mb-4 px-2" />

                <form>
                    <div class="px-2">
                        <AppLabel for="email">{{ __('Your Email') }}</AppLabel>
                        <AppInputText
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
                <div class="px-2">
                    <AppButton
                        class="btn btn-primary flex w-full justify-center"
                        @click="submitForm"
                    >
                        {{ __('Send Password Reset Link') }}
                    </AppButton>

                    <p class="mt-3">
                        <AppLink :href="route('adminAuth.loginForm')">
                            {{ __('Back to Login') }}
                        </AppLink>
                    </p>
                </div>
            </template>
        </AppCard>
    </AppAuthShell>
</template>

<script>
import GuestLayout from '@/Layouts/GuestLayout.vue'

export default {
    layout: GuestLayout
}
</script>

<script setup>
import { Head } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/vue3'
import useFormErrors from '@/Composables/useFormErrors'

const form = useForm({
    email: ''
})

function submitForm() {
    form.post(route('adminAuth.sendResetLinkEmail'))
}

const { errorsFields } = useFormErrors()
</script>
