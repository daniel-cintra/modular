<template>
    <Head title="Login"></Head>
    <AppAuthShell>
        <AppAuthLogo />

        <form @submit.prevent="submitForm">
            <AppCard class="w-80 space-y-2 bg-skin-neutral-2">
                <template #title>
                    <h3
                        class="text-center text-lg font-semibold tracking-tight"
                    >
                        {{ __('Sign in to your account') }}
                    </h3>
                </template>

                <template #content>
                    <AppFormErrors class="mb-4" />

                    <div>
                        <AppLabel for="email">{{ __('Email') }}</AppLabel>
                        <AppInputText
                            id="email"
                            v-model="form.email"
                            name="email"
                            type="text"
                            class="w-full"
                            autocomplete="email"
                            :class="{
                                'input-error': errorsFields.includes('email')
                            }"
                        />
                    </div>

                    <div class="mt-6">
                        <AppLabel for="email">{{ __('Password') }}</AppLabel>
                        <AppInputPassword
                            id="password"
                            v-model="form.password"
                            name="password"
                            class="w-full"
                            autocomplete="current-password"
                            :class="{
                                'input-error': errorsFields.includes('password')
                            }"
                        />
                    </div>

                    <div class="mt-4 flex items-center">
                        <AppCheckbox
                            id="remember"
                            v-model="form.remember"
                            name="remember"
                            :value="true"
                        />
                        <AppLabel for="remember" class="ml-3">{{
                            __('Remember me')
                        }}</AppLabel>
                    </div>
                </template>

                <template #footer>
                    <AppButton
                        class="btn btn-primary flex w-full justify-center"
                        aria-label="botao submit"
                        type="submit"
                        @click="submitForm"
                        >{{ __('Sign in') }}</AppButton
                    >

                    <p class="mt-3">
                        <AppLink :href="route('adminAuth.forgotPassword')">
                            {{ __('Forgot your password?') }}
                        </AppLink>
                    </p>
                </template>
            </AppCard>
        </form>
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
    email: '',
    password: '',
    remember: false
})

function submitForm() {
    form.post(route('adminAuth.login'))
}

const { errorsFields } = useFormErrors()
</script>
