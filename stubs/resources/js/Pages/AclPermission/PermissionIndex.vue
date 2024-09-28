<template>
    <Head :title="title"></Head>
    <AppSectionHeader :title="title" :bread-crumb="breadCrumb">
        <template #right>
            <AppButton
                class="btn btn-primary"
                @click="$inertia.visit(route('aclPermission.create'))"
            >
                <i class="ri-add-fill mr-1"></i>
                {{ __('Create Permission') }}
            </AppButton>
        </template>
    </AppSectionHeader>

    <AppDataSearch
        v-if="permissions.data.length || route().params.searchTerm"
        :url="route('aclPermission.index')"
        fields-to-search="name"
    ></AppDataSearch>

    <AppDataTable v-if="permissions.data.length" :headers="headers">
        <template #TableBody>
            <tbody>
                <AppDataTableRow
                    v-for="(item, index) in permissions.data"
                    :key="item.id"
                >
                    <AppDataTableData>
                        {{
                            (permissions.current_page - 1) *
                                permissions.per_page +
                            (index + 1)
                        }}
                    </AppDataTableData>

                    <AppDataTableData>
                        {{ item.name }}
                    </AppDataTableData>

                    <AppDataTableData>
                        <!-- edit permission -->
                        <AppTooltip :text="__('Edit Permission')" class="mr-2">
                            <AppButton
                                class="btn btn-icon btn-primary"
                                @click="
                                    $inertia.visit(
                                        route('aclPermission.edit', item.id)
                                    )
                                "
                            >
                                <i class="ri-edit-line"></i>
                            </AppButton>
                        </AppTooltip>

                        <!-- delete permission -->
                        <AppTooltip :text="__('Delete Permission')">
                            <AppButton
                                class="btn btn-icon btn-destructive"
                                @click="
                                    confirmDelete(
                                        route('aclPermission.destroy', item.id)
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
        :links="permissions.links"
        :from="permissions.from"
        :to="permissions.to"
        :total="permissions.total"
        class="mt-4 justify-center"
    ></AppPaginator>

    <AppAlert v-if="!permissions.data.length" class="mt-4">
        {{ __('No permissions found.') }}
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
    permissions: {
        type: Object,
        default: () => {}
    }
})

const breadCrumb = [
    { label: 'Home', href: route('dashboard.index') },
    { label: 'Permissions', last: true }
]

const headers = ['SL', 'Name', 'Actions']

const confirmDialogRef = ref(null)
const confirmDelete = (deleteRoute) => {
    confirmDialogRef.value.openModal(deleteRoute)
}
</script>
