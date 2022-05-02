<template>
    <main class="content main">
        <header class="header">
            <Head :title="pageTitle"/>
            <h1>{{ pageTitle }}</h1>
        </header>
        <section class="auto-margin max-width-sm my-5">
             <primevue-card class="mb-3">
                <template #content>
                    <avatar-editor :avatar="avatar" class="auto-margin width-xs"/>
                </template>
            </primevue-card>
        </section>
    </main>
</template>

<script>
import { mapState } from 'pinia';
import { Auth } from '@/stores/auth.js';
import { Head } from '@inertiajs/inertia-vue3';
import AppLayout from '@/layouts/App.vue';
import AvatarEditor from '@/components/ui/avatars/AvatarEditor.vue';
import PrimevueCard from 'primevue/card';

export default {
    layout: AppLayout,

    components: {
        AvatarEditor,
        Head,
        PrimevueCard,
    },

    props: {
        avatar: {
            type: Object,
            required: true,
        },
    },

    computed: {
        ...mapState(Auth, ['user']),
        isMyAvatar() {
            return this.user
                ? this.avatar.avatarable.type === 'profile' && this.user.profile.id === this.avatar.avatarable.id
                : false;
        },
        pageTitle() {
            return this.isMyAvatar ? 'Update My Avatar' : 'Update Profile Avatar';
        },
    },
};
</script>
