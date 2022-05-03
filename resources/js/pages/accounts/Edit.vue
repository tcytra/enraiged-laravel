<template>
    <main class="account edit content main">
        <Head :title="pageTitle"/>
        <header class="header">
            <h1>{{ pageTitle }}</h1>
            <div class="actions">
                <div class="action go-back" @click="back()">
                    <primevue-button class="button p-button-info p-button-text"
                        icon="pi pi-sync"
                        label="Back"/>
                </div>
            </div>
        </header>
        <section class="container">
            <account-form :builder="builder"/>
        </section>
    </main>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';
import AppLayout from '@/layouts/App.vue';
import AccountForm from '@/components/accounts/forms/AccountForm';
import PrimevueButton from 'primevue/button';

export default {
    layout: AppLayout,

    components: {
        Head,
        AccountForm,
        PrimevueButton,
    },

    props: {
        builder: {
            type: Object,
            required: true,
        },
    },

    computed: {
        isMyAccount() {
            return this.$attrs.auth.user.id === this.builder.resource.id;
        },
        pageTitle() {
            return this.isMyAccount ? 'Update My Account' : 'Update Account';
        },
    },

    methods: {
        back() {
            window.history.go(-1);
        },
    },
};
</script>
