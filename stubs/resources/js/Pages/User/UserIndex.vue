<template>
    <AppSectionHeader :title="__('Users')" :bread-crumb="breadCrumb">
        <template #right>
            <Button
                :label="__('Create User')"
                @click="$inertia.visit(route('user.create'))"
            />
        </template>
    </AppSectionHeader>

    <DataTable
        ref="dataTable"
        :value="users.data"
        :paginator="true"
        :rows="users.per_page"
        :lazy="true"
        :total-records="users.total"
        :first="users.from"
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
        <template #empty> {{ __('No users found') }} </template>

        <Column field="name" :header="__('Name')" />
        <Column field="email" header="Email" />

        <Column :exportable="false" style="min-width: 8rem">
            <template #body="slotProps">
                <Button
                    v-tooltip.top="__('User Roles')"
                    v-btn-icon
                    class="mr-2"
                    @click="
                        $inertia.visit(
                            route('aclUserRole.edit', slotProps.data.id)
                        )
                    "
                >
                    <i class="ri-account-box-line text-xl"></i>
                </Button>

                <Button
                    v-tooltip.top="__('User Permissions')"
                    v-btn-icon
                    class="mr-2"
                    @click="
                        $inertia.visit(
                            route('aclUserPermission.edit', slotProps.data.id)
                        )
                    "
                >
                    <i class="ri-shield-keyhole-line text-xl"></i>
                </Button>

                <Button
                    v-tooltip.top="__('Edit User')"
                    v-btn-icon
                    class="mr-2"
                    @click="
                        $inertia.visit(route('user.edit', slotProps.data.id))
                    "
                >
                    <i class="ri-edit-line text-xl"></i>
                </Button>

                <Button
                    v-tooltip.top="__('Delete User')"
                    v-btn-icon="'danger'"
                    @click="confirmDelete('user.destroy', slotProps.data)"
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
    users: {
        type: Object,
        default: () => {}
    }
})

const breadCrumb = [
    { label: 'Home', href: route('dashboard.index') },
    { label: 'Users', last: true }
]

const { searchTerm, fetchData, clearSearch } = useDataSearch(
    route('user.index'),
    'name'
)

const pageChange = (event) => {
    const params = { page: ++event.page, rowsPerPage: event.rows }
    fetchData(params)
}

const { confirmDelete } = useConfirmDelete()
</script>
