<template>
    <div>
        <Head title="Dashboard" />
        <h1 class="mb-8 text-3xl font-bold">Dashboard</h1>
        <p class="mb-8 leading-normal">
            This document is ready for content.
        </p>
    </div>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';
import Layout from '@/layouts/Default.vue';

export default {
    components: {
        Head,
    },
    layout: Layout,
};
</script>
