<template>
    <main class="main content">
        <Head title="Dashboard" />
        <header>
            <h1 class="p-3">Dashboard</h1>
        </header>
        <article>
            <p class="text m-3">This document is ready for content.</p>
        </article>
    </main>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';
import DefaultLayout from '@/layouts/Default.vue';

export default {
    components: {
        Head,
    },
    layout: DefaultLayout,
};
</script>
