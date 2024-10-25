<template>
    <li class="block">
        <Link
            v-if="menuItem.label && menuItem.link && can(menuItem.permission)"
            :href="menuItem.link"
            class="flex rounded-sm px-4 py-2 transition duration-300 ease-in-out hover:bg-skin-neutral-4 hover:text-skin-neutral-12"
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

defineProps({
    menuItem: {
        type: Object,
        default: () => {}
    }
})

const { can } = useAuthCan()
</script>
