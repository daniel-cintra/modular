<template>
    <AppSectionHeader :title="__('User Permissions')" :bread-crumb="breadCrumb">
    </AppSectionHeader>

    <AppCard>
        <template #title>
            {{ __('User Permissions for') }}:
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
                            v-for="permission in column"
                            :key="permission.id"
                            class="mb-4 flex items-center"
                        >
                            <AppCheckbox
                                :id="permission.name"
                                v-model="form.userPermissions"
                                name="permission"
                                :value="permission"
                            />
                            <AppLabel :for="permission.name" class="ml-2">
                                {{ permission.name }}
                            </AppLabel>
                        </div>
                    </div>
                </form>
            </div>

            <AppAlert v-else class="mt-4">
                {{ __('No permissions found') }}
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
    userPermissions: {
        type: Array,
        required: true
    },
    permissions: {
        type: Array,
        required: true
    }
})

const breadCrumb = [
    { label: 'Home', href: route('dashboard.index') },
    { label: 'Users', href: route('user.index') },
    { label: 'User Permissions', last: true }
]

const form = useForm({
    userPermissions: props.userPermissions
})

const chunks = computed(() => {
    const itensPerColumn = props.permissions.length / 3

    return chunk(props.permissions, Math.ceil(itensPerColumn))
})

const submitForm = () => {
    form.put(route('aclUserPermission.update', props.user.id))
}
</script>
