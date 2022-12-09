<template>
    <main class="content main">
        <page-header title="Accounts"/>
        <section class="container table">
            <account-index :template="template" />
        </section>
    </main>
</template>

<script>
import AppLayout from '@/layouts/App.vue';
import AccountIndex from '@/components/accounts/tables/AccountIndex';
import PageHeader from '@/components/ui/pages/PageHeader.vue';

export default {
    layout: AppLayout,

    components: {
        AccountIndex,
        PageHeader,
    },

    props: {
        template: {
            type: Object,
            required: true,
        },
    },
};
</script>
