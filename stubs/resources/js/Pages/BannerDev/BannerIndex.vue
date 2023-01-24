<template>
    <AppSectionHeader
        :title="`Banners for section ${section.name}`"
        :bread-crumb="breadCrumb"
    >
        <template #right>
            <Button
                label="Create Banner"
                @click="
                    $inertia.visit(
                        route('modularBanner.create', {
                            sectionId: props.section.id
                        })
                    )
                "
            />
        </template>
    </AppSectionHeader>

    <DataTable
        ref="dataTable"
        :value="section.banners"
        :paginator="false"
        :rows="10"
        :lazy="true"
        class="mx-8 shadow"
        @row-reorder="onRowReorder"
    >
        <template #empty> No banners found. </template>

        <Column
            :row-reorder="true"
            header-style="width: 3rem"
            :reorderable-column="false"
        />
        <Column field="name" />

        <Column field="id" header="Id" />
        <Column field="title" header="Title" />

        <Column header="Image" style="min-width: 8rem">
            <template #body="slotProps">
                <img
                    :src="slotProps.data.image_path"
                    :alt="slotProps.data.title"
                    class="w-32"
                />
            </template>
        </Column>

        <Column :exportable="false" style="min-width: 8rem">
            <template #body="slotProps">
                <Button
                    v-tooltip.top="'Edit Banner'"
                    v-btn-icon
                    class="mr-2"
                    @click="
                        $inertia.visit(
                            route('modularBanner.edit', slotProps.data.id)
                        )
                    "
                >
                    <i class="ri-edit-line text-xl"></i>
                </Button>

                <Button
                    v-tooltip.top="'Delete Banner'"
                    v-btn-icon="'danger'"
                    @click="
                        confirmDelete('modularBanner.destroy', slotProps.data)
                    "
                >
                    <i class="ri-delete-bin-line text-xl"></i>
                </Button>
            </template>
        </Column>
    </DataTable>
</template>

<script setup>
import { router } from '@inertiajs/vue3'
import useConfirmDelete from '@/Composables/useConfirmDelete'

const props = defineProps({
    section: {
        type: Object,
        default: () => {}
    }
})

const breadCrumb = [
    { label: 'Home', href: route('dashboard.index') },
    { label: 'Banner Sections', href: route('modularBannerSection.index') },
    { label: `Banners ${props.section.name}`, last: true }
]

const onRowReorder = (event) => {
    router.put(route('modularBanner.updateOrder'), {
        banners: event.value
    })
}

const { confirmDelete } = useConfirmDelete()
</script>
