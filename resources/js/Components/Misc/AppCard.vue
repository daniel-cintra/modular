<template>
    <div class="mt-4 rounded-md bg-skin-neutral-2 shadow">
        <div class="rounded-t-md bg-skin-neutral-3 px-4 py-2">
            <h3 class="text-xl font-semibold tracking-tight">
                <slot name="title"> </slot>
            </h3>

            <slot name="description"> </slot>
        </div>

        <div class="p-4">
            <slot name="content"></slot>
        </div>

        <div v-if="$slots.footer" class="px-4 py-2 pb-4">
            <slot name="footer"></slot>
        </div>
    </div>
</template>
