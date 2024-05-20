<template>
    <AppSectionHeader :title="__('User Roles')" :bread-crumb="breadCrumb">
    </AppSectionHeader>

    <AppCard>
        <template #title>
            {{ __('User Roles for') }}:
            <span class="text-skin-primary-10">{{ user.name }}</span>
        </template>

        <template #content>
            <div v-if="chunks.length">
                <AppFormErrors class="mb-4" />
                <form class="mt-5 flex">
                    <div
                        v-for="(column, index) in chunks"
                        :key="index"
                        class="w-1/3"
                    >
                        <div
                            v-for="role in column"
                            :key="role.id"
                            class="mb-4 flex items-center"
                        >
                            <AppCheckbox
                                :id="role.name"
                                v-model="form.userRoles"
                                name="role"
                                :value="role"
                            />
                            <AppLabel :for="role.name" class="ml-2">
                                {{ role.name }}
                            </AppLabel>
                        </div>
                    </div>
                </form>
            </div>

            <AppAlert v-else class="mt-4">
                {{ __('No roles found') }}
            </AppAlert>
        </template>

        <template v-if="chunks.length" #footer>
            <AppButton class="btn btn-primary" @click="submitForm">
                {{ __('Save') }}
            </AppButton>
        </template>
    </AppCard>
</template>

<script setup>
import { computed } from 'vue'
import { useForm } from '@inertiajs/vue3'
import chunk from '@/Utils/chunk'

const props = defineProps({
    user: {
        type: Object,
        required: true
    },
    roles: {
        type: Array,
        required: true
    }
})

const breadCrumb = [
    { label: 'Home', href: route('dashboard.index') },
    { label: 'Users', href: route('user.index') },
    { label: 'User Roles', last: true }
]

const form = useForm({
    userRoles: props.user.roles
})

const chunks = computed(() => {
    const itensPerColumn = props.roles.length / 3

    return chunk(props.roles, Math.ceil(itensPerColumn))
})

const submitForm = () => {
    form.put(route('aclUserRole.update', props.user.id))
}
</script>
