<template>
    <main class="content main">
        <page-header back-button fixed :actions="actions" :title="title"/>
        <section class="auto-margin container max-width-xl">
            <login-form :template="template"/>
        </section>
    </main>
</template>

<script>
import App from '@/layouts/App.vue';
import PageHeader from '@/components/ui/pages/PageHeader.vue';
import LoginForm from '@/components/users/forms/LoginForm.vue';

export default {
    layout: App,

    components: {
        PageHeader,
        LoginForm,
    },

    inject: ['i18n'],

    props: {
        actions: {
            type: Array,
            default: [],
        },
        user: {
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
            return this.user.is_myself ? 'Update My Login' : 'Update Login';
        },
    },
};
</script>
