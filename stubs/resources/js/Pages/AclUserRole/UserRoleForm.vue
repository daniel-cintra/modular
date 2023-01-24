<template>
    <AppSectionHeader title="User Roles" :bread-crumb="breadCrumb">
    </AppSectionHeader>

    <Card class="mx-8">
        <template #title>
            User Roles for:
            <span class="text-skin-secondary">{{ user.name }}</span>
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
                        v-for="role in column"
                        :key="role.id"
                        class="mb-4 flex items-center"
                    >
                        <Checkbox
                            v-model="form.userRoles"
                            :input-id="role.name"
                            name="role"
                            :value="role"
                        />
                        <label :for="role.name" class="ml-2">
                            {{ role.name }}
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
