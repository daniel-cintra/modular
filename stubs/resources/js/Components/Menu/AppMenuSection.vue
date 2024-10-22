<template>
    <!-- section label or single section link -->
    <app-menu-item v-if="!item.link || !item.children" :menu-item="item" />

    <!-- item with children -->
    <template v-if="item.children">
        <!-- menu level 1 -->
        <app-menu-item
            v-for="(level1Item, level1Index) in item.children"
            :key="level1Index"
            :menu-item="level1Item"
        >
            <ul v-if="level1Item.children">
                <!-- menu level 2 -->
                <app-menu-item
                    v-for="(level2Item, level2Index) in level1Item.children"
                    :key="level2Index"
                    :menu-item="level2Item"
                >
                    <ul v-if="level2Item.children">
                        <!-- menu level 3 -->
                        <app-menu-item
                            v-for="(
                                level3Item, level3Index
                            ) in level2Item.children"
                            :key="level3Index"
                            :menu-item="level3Item"
                        />
                    </ul>
                </app-menu-item>
            </ul>
        </app-menu-item>
    </template>
</template>

<script setup>
defineProps({
    item: {
        type: Object,
        required: true
    }
})
</script>
