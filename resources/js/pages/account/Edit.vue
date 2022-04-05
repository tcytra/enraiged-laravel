<template>
    <Head title="Account Control" />
    <main class="account control content main">
        <header class="header">
            <h1 v-if="$page.url === '/my/account'">My Account</h1>
            <h1 v-else>Edit Account</h1>
        </header>
        <section class="auto-margin container max-width-xl">
            <account-form :builder="accountForm" />
        </section>
    </main>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';
import AppLayout from '@/layouts/App.vue';
import AccountForm from '@/components/accounts/forms/AccountForm';

export default {
    layout: AppLayout,

    components: {
        Head,
        AccountForm,
    },

    props: {
        accountForm: {
            type: Object,
            required: true,
        },
    },

    mounted() {
        this.$parent.$emit('close:auth');
    },
};
</script>
