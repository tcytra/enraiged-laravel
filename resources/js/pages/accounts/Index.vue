<template>
    <Head title="Accounts" />
    <main class="accounts index content main">
        <header class="header">
            <h1>Accounts</h1>
        </header>
        <section class="container">
            <account-index :builder="accountsIndex" />
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
        accountsIndex: {
            type: Object,
            required: true,
        },
    },
};
</script>
