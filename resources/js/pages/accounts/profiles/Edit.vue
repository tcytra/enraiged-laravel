<template>
    <main class="content main">
        <header class="header">
            <Head :title="pageTitle"/>
            <h1>{{ pageTitle }}</h1>
        </header>
        <section class="auto-margin max-width-sm my-5">
            <profile-form :builder="builder"/>
        </section>
    </main>
</template>

<script>
import { mapState } from 'pinia';
import { Auth } from '@/stores/auth.js';
import { Head } from '@inertiajs/inertia-vue3';
import AppLayout from '@/layouts/App.vue';
import ProfileForm from '@/components/accounts/forms/ProfileForm.vue';

export default {
    layout: AppLayout,

    components: {
        ProfileForm,
    },

    props: {
        builder: {
            type: Object,
            required: true,
        },
    },

    computed: {
        ...mapState(Auth, ['user']),
        isMyLogin() {
            return this.user ? this.user.id === this.builder.resource.id : false;
        },
        pageTitle() {
            return this.isMyLogin ? 'Update My Profile' : 'Update Profile';
        },
    },
};
</script>
