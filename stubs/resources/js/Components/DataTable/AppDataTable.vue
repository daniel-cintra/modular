<template>
    <div class="overflow-x-auto">
        <table class="w-full table-auto text-left">
            <!-- TableHead     -->
            <template v-if="$slots.TableHead">
                <slot name="TableHead"></slot>
            </template>

            <template v-if="!$slots.TableHead && headers.length">
                <AppDataTableHead :headers="headers"></AppDataTableHead>
            </template>

            <!-- TableBody     -->
            <template v-if="$slots.TableBody">
                <slot name="TableBody"></slot>
            </template>
        </table>
    </div>
</template>

<script setup>
defineProps({
    headers: {
        type: Array,
        default: () => []
    }
})
</script>
