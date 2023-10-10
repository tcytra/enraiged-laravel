<template>
    <main class="content main">
        <page-header back-button fixed :actions="actions" :title="title"/>
        <section class="auto-margin container max-width-xl">
            <page-messages :messages="messages" @dismiss="messages.splice($event, 1)"/>
            <settings-form :template="template"/>
        </section>
    </main>
</template>

<script>
import App from '@/layouts/App.vue';
import PageHeader from '@/components/ui/pages/PageHeader.vue';
import PageMessages from '@/components/ui/pages/PageMessages.vue';
import SettingsForm from '@/components/users/forms/SettingsForm.vue';

export default {
    layout: App,

    components: {
        PageHeader,
        PageMessages,
        SettingsForm,
    },

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
            return this.user.is_myself ? 'Update My Settings' : 'User Settings';
        },
    },
};
</script>
