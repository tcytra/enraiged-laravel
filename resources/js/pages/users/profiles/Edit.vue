<template>
    <main class="content main">
        <page-header back-button fixed :actions="actions" :title="title"/>
        <section class="auto-margin container max-width-xl">
            <page-messages :messages="messages" @dismiss="messages.splice($event, 1)"/>
            <profile-form :template="template"/>
        </section>
    </main>
</template>

<script>
import App from '@/layouts/App.vue';
import PageHeader from '@/components/ui/pages/PageHeader.vue';
import PageMessages from '@/components/ui/pages/PageMessages.vue';
import ProfileForm from '@/components/users/forms/ProfileForm.vue';

export default {
    layout: App,

    components: {
        PageHeader,
        PageMessages,
        ProfileForm,
    },

    inject: ['i18n'],

    props: {
        actions: {
            type: Array,
            default: [],
        },
        messages: {
            type: Array,
            default: [],
        },
        template: {
            type: Object,
            required: true,
        },
        user: {
            type: Object,
            required: true,
        },
    },

    computed: {
        title() {
            return this.user.is_myself ? 'Update My Details' : 'Update Profile';
        },
    },

    methods: {
        dismiss(index) {
            this.messages.splice(index, 1);
        },
    },
};
</script>
