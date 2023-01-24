<template>
    <AppSectionHeader title="Role Permissions" :bread-crumb="breadCrumb">
    </AppSectionHeader>

    <Card class="mx-8">
        <template #title>
            Role permissions for:
            <span class="text-skin-secondary">{{ role.name }}</span>
        </template>
        <template #content>
            <AppFormErrors class="mb-4" />
            <form class="flex">
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
                        <Checkbox
                            v-model="form.rolePermissions"
                            :input-id="permission.name"
                            name="permission"
                            :value="permission"
                        />
                        <label :for="permission.name" class="ml-2">
                            {{ permission.name }}
                        </label>
                    </div>
                </div>
            </form>
        </template>
        <template #footer>
            <Button label="Save" class="mt-1" @click="submitForm" />
        </template>
    </Card>
</template>

<script setup>
import { computed } from 'vue'
import { useForm } from '@inertiajs/vue3'
import chunk from 'lodash/chunk'

const props = defineProps({
    role: {
        type: Object,
        required: true
    },
    permissions: {
        type: Array,
        required: true
    }
})

const breadCrumb = [
    { label: 'Home', href: route('dashboard.index') },
    { label: 'Roles', href: route('aclRole.index') },
    { label: 'Role Permissions', last: true }
]

const form = useForm({
    rolePermissions: props.role.permissions
})

const chunks = computed(() => {
    const itensPerColumn = props.permissions.length / 3

    return chunk(props.permissions, Math.ceil(itensPerColumn))
})

const submitForm = () => {
    form.put(route('aclRolePermission.update', props.role.id))
}
</script>
