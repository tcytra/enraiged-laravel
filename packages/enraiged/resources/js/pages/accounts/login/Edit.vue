<template>
    <main class="content main">
        <page-header back-button :title="title"/>
        <section class="auto-margin container max-width-lg">
            <login-form :template="template"/>
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

    inject: ['i18n'],

    props: {
        account: {
            type: Object,
            required: true,
        },
        template: {
            type: Object,
            required: true,
        },
    },

    computed: {
        title() {
            return this.account.is_myself ? 'My Login' : 'Update Login';
        },
    },
};
</script>
