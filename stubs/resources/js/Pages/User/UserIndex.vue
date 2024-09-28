<template>
    <Head :title="title"></Head>
    <AppSectionHeader :title="title" :bread-crumb="breadCrumb">
        <template #right>
            <AppButton
                class="btn btn-primary"
                @click="$inertia.visit(route('user.create'))"
            >
                <i class="ri-add-fill mr-1"></i>
                {{ __('Create User') }}
            </AppButton>
        </template>
    </AppSectionHeader>

    <AppDataSearch
        v-if="users.data.length || route().params.searchTerm"
        :url="route('user.index')"
        fields-to-search="name"
    ></AppDataSearch>

    <AppDataTable v-if="users.data.length" :headers="headers">
        <template #TableBody>
            <tbody>
                <AppDataTableRow
                    v-for="(item, index) in users.data"
                    :key="item.id"
                >
                    <AppDataTableData>
                        {{
                            (users.current_page - 1) * users.per_page +
                            (index + 1)
                        }}
                    </AppDataTableData>

                    <AppDataTableData>
                        {{ item.name }}
                    </AppDataTableData>

                    <AppDataTableData>
                        {{ item.email }}
                    </AppDataTableData>

                    <AppDataTableData>
                        <!-- edit user roles -->
                        <AppTooltip :text="__('User Roles')" class="mr-2">
                            <AppButton
                                class="btn btn-icon btn-primary"
                                @click="
                                    $inertia.visit(
                                        route('aclUserRole.edit', item.id)
                                    )
                                "
                            >
                                <i class="ri-account-box-line"></i>
                            </AppButton>
                        </AppTooltip>

                        <!-- edit user permissions -->
                        <AppTooltip :text="__('User Permissions')" class="mr-2">
                            <AppButton
                                class="btn btn-icon btn-primary"
                                @click="
                                    $inertia.visit(
                                        route('aclUserPermission.edit', item.id)
                                    )
                                "
                            >
                                <i class="ri-shield-keyhole-line"></i>
                            </AppButton>
                        </AppTooltip>

                        <!-- edit user -->
                        <AppTooltip :text="__('Edit User')" class="mr-2">
                            <AppButton
                                class="btn btn-icon btn-primary"
                                @click="
                                    $inertia.visit(route('user.edit', item.id))
                                "
                            >
                                <i class="ri-edit-line"></i>
                            </AppButton>
                        </AppTooltip>

                        <!-- delete user -->
                        <AppTooltip :text="__('Delete User')">
                            <AppButton
                                class="btn btn-icon btn-destructive"
                                @click="
                                    confirmDelete(
                                        route('user.destroy', item.id)
                                    )
                                "
                            >
                                <i class="ri-delete-bin-line"></i>
                            </AppButton>
                        </AppTooltip>
                    </AppDataTableData>
                </AppDataTableRow>
            </tbody>
        </template>
    </AppDataTable>

    <AppPaginator
        :links="users.links"
        :from="users.from"
        :to="users.to"
        :total="users.total"
        class="mt-4 justify-center"
    ></AppPaginator>

    <AppAlert v-if="!users.data.length" class="mt-4">
        {{ __('No users found') }}
    </AppAlert>

    <AppConfirmDialog ref="confirmDialogRef"></AppConfirmDialog>
</template>

<script setup>
import { ref } from 'vue'
import { Head } from '@inertiajs/vue3'
import useTitle from '@/Composables/useTitle'
import useAuthCan from '@/Composables/useAuthCan'

const { title } = useTitle('Users')
const { can } = useAuthCan()

const props = defineProps({
    users: {
        type: Object,
        default: () => {}
    }
})

const breadCrumb = [
    { label: 'Home', href: route('dashboard.index') },
    { label: 'Users', last: true }
]

const headers = ['SL', 'Name', 'Email', 'Actions']

const confirmDialogRef = ref(null)
const confirmDelete = (deleteRoute) => {
    confirmDialogRef.value.openModal(deleteRoute)
}
</script>
