<template>
    <Head title="Account" />
    <main class="account edit content main">
        <header class="header">
            <h1 v-if="account.id === 1">My Account</h1>
            <h1 v-else>Account</h1>
        </header>
        ...
    </main>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';
import AppLayout from '@/layouts/App.vue';

export default {
    layout: AppLayout,

    components: {
        Head,
    },

    props: {
        account: {
            type: Object,
            required: true,
        },
    },
};
</script>
