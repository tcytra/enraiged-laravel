<template>
    <main class="content main">
        <page-header back-button :title="title"/>
        <section class="auto-margin container max-width-lg">
            <login-form :builder="builder"/>
        </section>
    </main>
</template>

<script>
import AppLayout from '@/layouts/App.vue';
import PageHeader from '@/components/ui/pages/PageHeader.vue';
import LoginForm from '@/components/accounts/forms/LoginForm.vue';

export default {
    layout: AppLayout,

    components: {
        PageHeader,
        LoginForm,
    },

    props: {
        account: {
            type: Object,
            required: true,
        },
        builder: {
            type: Object,
            required: true,
        },
    },

    computed: {
        title() {
            return this.account.is_myself ? 'Update My Login' : 'Update Login';
        },
    },
};
</script>
