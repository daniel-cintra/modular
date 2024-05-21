<!-- eslint-disable vue/no-v-html -->
<!-- eslint-disable vue/no-v-text-v-html-on-component -->
<template>
    <div v-if="links.length > 3">
        <div class="mx-auto flex flex-wrap" :class="$attrs.class">
            <template v-for="(link, index) in links" :key="index">
                <div
                    v-if="link.url === null"
                    class="mb-1 mr-1 rounded border px-3 py-2 text-sm leading-4 opacity-30"
                    v-html="link.label"
                />
                <Link
                    v-else
                    class="mb-1 mr-1 rounded border px-3 py-2 text-sm leading-4 hover:bg-skin-primary-10 hover:text-skin-primary-1 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2"
                    :class="{
                        'bg-skin-primary-9 text-skin-primary-2': link.active
                    }"
                    :href="link.url"
                    v-html="link.label"
                ></Link>
            </template>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    links: {
        type: Array,
        required: true
    }
})

defineOptions({
    inheritAttrs: false
})
</script>
