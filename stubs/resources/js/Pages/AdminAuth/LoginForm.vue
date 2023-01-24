<template>
    <AppAuthShell>
        <AppAuthLogo />

        <Card class="space-y-4 p-6">
            <template #title> Sign in to your account </template>

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

                    <div class="mt-6">
                        <label for="email">Password</label>
                        <Password
                            id="password"
                            v-model="form.password"
                            toggle-mask
                            :feedback="false"
                            class="w-full"
                            :class="{
                                'p-invalid': errorsFields.includes('password')
                            }"
                            input-class="w-full"
                        />
                    </div>

                    <div class="mt-4">
                        <Checkbox
                            v-model="form.remember"
                            input-id="remember"
                            name="remember"
                            :binary="true"
                            :value="true"
                        />
                        <label for="remember" class="ml-2"> Remember me </label>
                    </div>
                </form>
            </template>

            <template #footer>
                <Button label="Sign in" class="my-4" @click="submitForm" />

                <p class="text-sm font-light text-skin-base-content">
                    <Link
                        :href="route('adminAuth.forgotPassword')"
                        class="text-primary-600 dark:text-primary-500 font-medium hover:underline"
                        >Forgot your password?</Link
                    >
                </p>
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
    email: 'user@example.com',
    password: 'password',
    remember: false
})

function submitForm() {
    form.post(route('adminAuth.login'))
}

const { errorsFields } = useFormErrors()
</script>
