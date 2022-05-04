<template>
    <main class="content main">
        <page-header back-button :title="title"/>
        <section class="auto-margin container max-width-lg">
            <account-form :builder="builder"/>
        </section>
    </main>
</template>

<script>
import AppLayout from '@/layouts/App.vue';
import AccountForm from '@/components/accounts/forms/AccountForm';
import PageHeader from '@/components/ui/pages/PageHeader.vue';
import PrimevueButton from 'primevue/button';

export default {
    layout: AppLayout,

    components: {
        AccountForm,
        PageHeader,
        PrimevueButton,
    },

    props: {
        builder: {
            type: Object,
            required: true,
        },
    },

    computed: {
        myself() {
            return this.$attrs.auth.user.id === this.builder.resource.id;
        },
        title() {
            return this.myself ? 'Update My Account' : 'Update Account';
        },
    },
};
</script>
