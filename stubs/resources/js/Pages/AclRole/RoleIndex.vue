<template>
    <Head :title="title"></Head>
    <AppSectionHeader :title="title" :bread-crumb="breadCrumb">
        <template #right>
            <AppButton
                class="btn btn-primary"
                @click="$inertia.visit(route('aclRole.create'))"
            >
                <i class="ri-add-fill mr-1"></i>
                {{ __('Create Role') }}
            </AppButton>
        </template>
    </AppSectionHeader>

    <AppDataSearch
        v-if="roles.data.length || route().params.searchTerm"
        :url="route('aclRole.index')"
        fields-to-search="name"
    ></AppDataSearch>

    <AppDataTable v-if="roles.data.length" :headers="headers">
        <template #TableBody>
            <tbody>
                <AppDataTableRow
                    v-for="(item, index) in roles.data"
                    :key="item.id"
                >
                    <AppDataTableData>
                        {{
                            (roles.current_page - 1) * roles.per_page +
                            (index + 1)
                        }}
                    </AppDataTableData>

                    <AppDataTableData>
                        {{ item.name }}
                    </AppDataTableData>

                    <AppDataTableData>
                        <!-- role permissions -->
                        <AppTooltip :text="__('Role Permissions')" class="mr-2">
                            <AppButton
                                class="btn btn-icon btn-primary"
                                @click="
                                    $inertia.visit(
                                        route('aclRolePermission.edit', item.id)
                                    )
                                "
                            >
                                <i class="ri-shield-keyhole-line"></i>
                            </AppButton>
                        </AppTooltip>

                        <!-- edit role -->
                        <AppTooltip :text="__('Edit Role')" class="mr-2">
                            <AppButton
                                class="btn btn-icon btn-primary"
                                @click="
                                    $inertia.visit(
                                        route('aclRole.edit', item.id)
                                    )
                                "
                            >
                                <i class="ri-edit-line"></i>
                            </AppButton>
                        </AppTooltip>

                        <!-- delete role -->
                        <AppTooltip :text="__('Delete Role')">
                            <AppButton
                                class="btn btn-icon btn-destructive"
                                @click="
                                    confirmDelete(
                                        route('aclRole.destroy', item.id)
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
        :links="roles.links"
        :from="roles.from"
        :to="roles.to"
        :total="roles.total"
        class="mt-4 justify-center"
    ></AppPaginator>

    <AppAlert v-if="!roles.data.length" class="mt-4">
        {{ __('No roles found') }}
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
    roles: {
        type: Object,
        default: () => {}
    }
})

const breadCrumb = [
    { label: 'Home', href: route('dashboard.index') },
    { label: 'Roles', last: true }
]

const headers = ['SL', 'Name', 'Actions']

const confirmDialogRef = ref(null)
const confirmDelete = (deleteRoute) => {
    confirmDialogRef.value.openModal(deleteRoute)
}
</script>
