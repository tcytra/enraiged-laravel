<template>
    <main class="content main">
        <page-header back-button :header="header" :title="title"/>
        <section class="auto-margin container max-width-md">
            <page-messages class="mb-3" :messages="messages" @dismiss="messages.splice($event, 1)"/>
            <vue-form :template="template" updating/>
        </section>
    </main>
</template>

<script>
import AppLayout from '@/layouts/App.vue';
import PageHeader from '@/components/ui/pages/PageHeader.vue';
import PageMessages from '@/components/ui/pages/PageMessages.vue';
import VueForm from '@/components/forms/VueForm.vue';

export default {
    layout: AppLayout,

    components: {
        PageHeader,
        PageMessages,
        VueForm,
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
        messages: {
            type: Array,
            default: [],
        },
    },

    computed: {
        header() {
            return this.account.is_myself
                ? 'My Account'
                : `${this.i18n('Update Account')}: ${this.account.profile.name}`;
        },
        title() {
            return this.account.is_myself
                ? this.header
                : 'Update Account';
        },
    },
};
</script>
