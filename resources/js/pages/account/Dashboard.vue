<template>
    <Head title="Account Dashboard" />
    <main class="main content">
        <header class="header">
            <h1>Account Control</h1>
        </header>
        <section class="container">
            <primevue-card class="mb-3">
                <template #content>
                    This is your account control panel.
                </template>
            </primevue-card>
        </section>
    </main>
</template>

<script>
import AppLayout from '@/layouts/App.vue';
import { Head } from '@inertiajs/inertia-vue3';
import PrimevueCard from 'primevue/card';

export default {
    layout: AppLayout,
    components: {
        Head,
        PrimevueCard,
    },
};
</script>
