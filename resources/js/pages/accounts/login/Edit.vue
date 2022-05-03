<template>
    <main class="content main">
        <header class="header">
            <Head :title="pageTitle"/>
            <h1>{{ pageTitle }}</h1>
            <div class="actions">
                <div class="action go-back" @click="back()">
                    <primevue-button class="button p-button-info p-button-text"
                        icon="pi pi-sync"
                        label="Back"/>
                </div>
            </div>
        </header>
        <section class="auto-margin max-width-sm my-5">
            <login-form :builder="builder"/>
        </section>
    </main>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';
import AppLayout from '@/layouts/App.vue';
import PrimevueButton from 'primevue/button';
import LoginForm from '@/components/accounts/forms/LoginForm.vue';

export default {
    layout: AppLayout,

    components: {
        Head,
        LoginForm,
        PrimevueButton,
    },

    props: {
        builder: {
            type: Object,
            required: true,
        },
    },

    computed: {
        isMyLogin() {
            return this.$attrs.auth.user.id === this.builder.resource.id;
        },
        pageTitle() {
            return this.isMyLogin ? 'Update My Login' : 'Update Login';
        },
    },

    methods: {
        back() {
            window.history.go(-1);
        },
    },
};
</script>
