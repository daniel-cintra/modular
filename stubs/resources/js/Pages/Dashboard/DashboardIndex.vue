<template>
    <Head title="Dashboard"></Head>
    <div
        class="shadow-xs mt-6 flex flex-col justify-between rounded-md border border-skin-neutral-4 bg-skin-neutral-2 px-4 py-2 md:flex-row"
    >
        <div>
            <i class="ri-megaphone-line"></i>
            Welcome
            <span class="font-bold">{{ $page.props.auth.user.name }}</span> !
        </div>
    </div>
</template>

<script setup>
import { Head } from '@inertiajs/vue3'
</script>
