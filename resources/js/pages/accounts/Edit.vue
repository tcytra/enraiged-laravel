<template>
    <main class="content main">
        <page-header back-button :header="header" :title="title"/>
        <section class="auto-margin container max-width-lg">
            <page-messages class="mb-3" :messages="messages" @dismiss="messages.splice($event, 1)"/>
            <account-form :builder="builder"/>
        </section>
    </main>
</template>

<script>
import AppLayout from '@/layouts/App.vue';
import AccountForm from '@/components/accounts/forms/AccountForm';
import PageHeader from '@/components/ui/pages/PageHeader.vue';
import PageMessages from '@/components/ui/pages/PageMessages.vue';
import PrimevueButton from 'primevue/button';

export default {
    layout: AppLayout,

    components: {
        AccountForm,
        PageHeader,
        PageMessages,
        PrimevueButton,
    },

    inject: ['i18n'],

    props: {
        account: {
            type: Object,
            required: true,
        },
        builder: {
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
