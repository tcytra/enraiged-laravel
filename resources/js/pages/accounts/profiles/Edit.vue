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
            <profile-form :builder="builder"/>
        </section>
    </main>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';
import AppLayout from '@/layouts/App.vue';
import PrimevueButton from 'primevue/button';
import ProfileForm from '@/components/accounts/forms/ProfileForm.vue';

export default {
    layout: AppLayout,

    components: {
        Head,
        PrimevueButton,
        ProfileForm,
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
            return this.isMyLogin ? 'Update My Profile' : 'Update Profile';
        },
    },

    methods: {
        back() {
            window.history.go(-1);
        },
    },
};
</script>
