<template>
    <Head title="Create Account" />
    <main class="accounts create content main">
        <header class="header">
            <h1>Create Account</h1>
        </header>
        <section class="container">
            form here
        </section>
    </main>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';
import AppLayout from '@/layouts/App.vue';
import AccountIndex from '@/components/accounts/tables/AccountIndex';

export default {
    layout: AppLayout,

    components: {
        Head,
        AccountIndex,
    },

    props: {
        template: {
            type: Object,
            required: true,
        },
    },
};
</script>
