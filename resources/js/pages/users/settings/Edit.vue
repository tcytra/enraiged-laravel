<template>
    <main class="content main">
        <page-header back-button :actions="actions" :title="title"/>
        <section class="auto-margin container max-width-lg">
            <settings-form class="shadow-1" :template="template"/>
        </section>
    </main>
</template>

<script>
import App from '@/layouts/App.vue';
import PageHeader from '@/components/ui/pages/PageHeader.vue';
import SettingsForm from '@/components/users/forms/SettingsForm.vue';

export default {
    layout: App,

    components: {
        PageHeader,
        SettingsForm,
    },

    props: {
        actions: {
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
