<template>
    <main class="content main">
        <page-header back-button :title="title"/>
        <section class="auto-margin container max-width-lg">
            <page-messages class="mb-3" :messages="messages" @dismiss="messages.splice($event, 1)"/>
            <profile-form :builder="builder"/>
        </section>
    </main>
</template>

<script>
import AppLayout from '@/layouts/App.vue';
import PageHeader from '@/components/ui/pages/PageHeader.vue';
import PageMessages from '@/components/ui/pages/PageMessages.vue';
import ProfileForm from '@/components/accounts/forms/ProfileForm.vue';

export default {
    layout: AppLayout,

    components: {
        PageHeader,
        PageMessages,
        ProfileForm,
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
        title() {
            return this.account.is_myself ? 'My Profile' : 'Update Profile';
        },
    },

    methods: {
        dismiss(index) {
            this.messages.splice(index, 1);
        },
    },
};
</script>
