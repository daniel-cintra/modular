<template>
    <li class="block">
        <Link
            v-if="menuItem.label && menuItem.link && can(menuItem.permission)"
            :href="menuItem.link"
            class="flex px-2 py-2 text-skin-base-content transition duration-300 ease-in hover:bg-skin-base-300"
        >
            <i :class="menuItem.icon" class="pr-3"></i>
            {{ __(menuItem.label) }}
        </Link>

        <span
            v-if="menuItem.label && !menuItem.link && can(menuItem.permission)"
            class="mt-3 block px-2 py-2 text-xs uppercase"
        >
            {{ __(menuItem.label) }}
        </span>

        <slot />
    </li>
</template>

<script setup>
import useAuthCan from '@/Composables/useAuthCan'

const props = defineProps({
    menuItem: {
        type: Object,
        default: () => {}
    }
})

const { can } = useAuthCan()
</script>
