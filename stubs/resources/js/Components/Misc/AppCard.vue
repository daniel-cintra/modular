<template>
    <div class="rounded bg-skin-neutral-2 p-12 shadow">
        <div>
            <h3 class="mb-5 text-2xl font-semibold tracking-tight">
                <slot name="title"> </slot>
            </h3>

            <slot name="description"> </slot>
        </div>

        <slot name="content"></slot>

        <div v-if="$slots.footer" class="mt-4">
            <slot name="footer"></slot>
        </div>
    </div>
</template>
