<template>
    <main class="content main">
        <page-header back-button :heading="heading" :title="title"/>
        <section class="auto-margin container max-width-md">
            <page-messages class="mb-3" :messages="messages" @dismiss="messages.splice($event, 1)"/>
            <vue-form :template="template" updating/>
        </section>
    </main>
</template>

<script>
import App from '@/layouts/App.vue';
import PageHeader from '@/components/ui/pages/PageHeader.vue';
import PageMessages from '@/components/ui/pages/PageMessages.vue';
import VueForm from '@/components/forms/VueForm.vue';

export default {
    layout: App,

    components: {
        PageHeader,
        PageMessages,
        VueForm,
    },

    inject: ['i18n'],

    props: {
        user: {
            type: Object,
            required: true,
        },
        template: {
            type: Object,
            required: true,
        },
        messages: {
            type: Array,
            default: [],
        },
    },

    computed: {
        heading() {
            return `${this.i18n('Update User')}: ${this.user.profile.name}`;
        },
        title() {
            return this.i18n('Update User');
        },
    },
};
</script>
