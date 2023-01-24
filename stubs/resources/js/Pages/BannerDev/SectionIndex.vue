<template>
    <AppSectionHeader title="Sections" :bread-crumb="breadCrumb">
        <template #right>
            <Button
                label="Create Section"
                @click="$inertia.visit(route('modularBannerSection.create'))"
            />
        </template>
    </AppSectionHeader>

    <DataTable
        ref="dataTable"
        :value="sections.data"
        :paginator="true"
        :rows="sections.per_page"
        :lazy="true"
        :total-records="sections.total"
        :first="sections.from"
        striped-rows
        class="mx-8 shadow"
        :rows-per-page-options="[10, 25, 50]"
        @page="pageChange($event)"
    >
        <template #header>
            <div class="flex justify-between">
                <Button
                    type="button"
                    icon="pi pi-filter-slash"
                    label="Clear"
                    class="p-button-sm"
                    @click="clearSearch"
                />
                <span class="p-input-icon-left">
                    <i class="pi pi-search" />
                    <InputText
                        v-model="searchTerm"
                        placeholder="Keyword Search"
                    />
                </span>
            </div>
        </template>
        <template #empty> No sections found. </template>

        <Column field="id" header="Id" />
        <Column field="name" header="Name" />
        <Column field="img_width" header="Width" />
        <Column field="img_height" header="Height" />

        <Column :exportable="false" style="min-width: 8rem">
            <template #body="slotProps">
                <Button
                    v-tooltip.top="'List Banners'"
                    v-btn-icon
                    class="mr-2"
                    @click="
                        $inertia.visit(
                            route('modularBanner.index', {
                                sectionId: slotProps.data.id
                            })
                        )
                    "
                >
                    <i class="ri-image-2-line text-xl"></i>
                </Button>

                <Button
                    v-tooltip.top="'Edit Section'"
                    v-btn-icon
                    class="mr-2"
                    @click="
                        $inertia.visit(
                            route(
                                'modularBannerSection.edit',
                                slotProps.data.id
                            )
                        )
                    "
                >
                    <i class="ri-edit-line text-xl"></i>
                </Button>

                <Button
                    v-tooltip.top="'Delete Section'"
                    v-btn-icon="'danger'"
                    @click="
                        confirmDelete(
                            'modularBannerSection.destroy',
                            slotProps.data
                        )
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
    sections: {
        type: Object,
        default: () => {}
    }
})

const breadCrumb = [
    { label: 'Home', href: route('dashboard.index') },
    { label: 'Banner Sections', last: true }
]

const { searchTerm, fetchData, clearSearch } = useDataSearch(
    route('modularBannerSection.index'),
    'name'
)

const pageChange = (event) => {
    const params = { page: ++event.page, rowsPerPage: event.rows }
    fetchData(params)
}

const { confirmDelete } = useConfirmDelete()
</script>
