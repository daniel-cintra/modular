<template>
    <Head title="Modular"></Head>
    <main>
        <article>
            <AppFlashMessage />
            <slot></slot>
        </article>
    </main>
</template>

<script setup>
import { Head } from '@inertiajs/vue3'
</script>
