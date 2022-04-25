<template>
    <Head title="Account Edit" />
    <main class="account edit content main">
        <header class="header">
            <h1 v-if="$page.url === '/my/account'">My Account</h1>
            <h1 v-else>Edit Account</h1>
        </header>
        <section class="container">
            <account-form :builder="builder" />
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
        builder: {
            type: Object,
            required: true,
        },
    },
};
</script>
