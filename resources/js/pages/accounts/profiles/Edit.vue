<template>
    <main class="content main">
        <page-header back-button :title="title"/>
        <section class="auto-margin container max-width-lg">
            <profile-form :builder="builder"/>
        </section>
    </main>
</template>

<script>
import AppLayout from '@/layouts/App.vue';
import PageHeader from '@/components/ui/pages/PageHeader.vue';
import PrimevueButton from 'primevue/button';
import ProfileForm from '@/components/accounts/forms/ProfileForm.vue';

export default {
    layout: AppLayout,

    components: {
        PageHeader,
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
        myself() {
            return this.$attrs.auth.user.id === this.builder.resource.id;
        },
        title() {
            return this.myself ? 'Update My Profile' : 'Update Profile';
        },
    },
};
</script>
