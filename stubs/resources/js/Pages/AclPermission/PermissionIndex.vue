<template>
    <AppSectionHeader :title="__('Permissions')" :bread-crumb="breadCrumb">
        <template #right>
            <Button
                :label="__('Create Permission')"
                @click="$inertia.visit(route('aclPermission.create'))"
            />
        </template>
    </AppSectionHeader>

    <DataTable
        :value="permissions.data"
        :paginator="true"
        :rows="permissions.per_page"
        :lazy="true"
        :total-records="permissions.total"
        :first="permissions.from"
        striped-rows
        class="mx-8 shadow"
        :rows-per-page-options="[10, 25, 50]"
        @page="pageChange($event)"
    >
        <template #header>
            <div class="flex justify-end">
                <Button
                    v-if="searchTerm"
                    :label="__('Clear Search')"
                    class="p-button-link p-button-sm mr-2"
                    @click="clearSearch"
                />
                <span class="p-input-icon-left">
                    <i class="pi pi-search" />
                    <InputText
                        v-model="searchTerm"
                        :placeholder="__('Search')"
                        class="font-normal"
                    />
                </span>
            </div>
        </template>
        <template #empty>{{ __('No permissions found') }}</template>

        <Column field="name" :header="__('Name')" />

        <Column :exportable="false" style="min-width: 8rem">
            <template #body="slotProps">
                <Button
                    v-btn-icon
                    v-tooltip.top="__('Edit Permission')"
                    class="mr-2"
                    @click="
                        $inertia.visit(
                            route('aclPermission.edit', slotProps.data.id)
                        )
                    "
                >
                    <i class="ri-edit-line text-xl"></i>
                </Button>
                <Button
                    v-tooltip.top="__('Delete Permission')"
                    v-btn-icon="'danger'"
                    @click="
                        confirmDelete('aclPermission.destroy', slotProps.data)
                    "
                >
                    <i class="ri-delete-bin-line text-xl"></i>
                </Button>
            </template>
        </Column>
    </DataTable>
</template>

<script setup>
import useDataSearch from '@/Composables/useDataSearch'
import useConfirmDelete from '@/Composables/useConfirmDelete'

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

const { searchTerm, fetchData, clearSearch } = useDataSearch(
    route('aclPermission.index'),
    'name'
)

const pageChange = (event) => {
    const params = { page: ++event.page, rowsPerPage: event.rows }
    fetchData(params)
}

const { confirmDelete } = useConfirmDelete()
</script>
