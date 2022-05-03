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
             <primevue-card class="mb-3">
                <template #content>
                    <avatar-editor :avatar="avatar" class="auto-margin width-xs"/>
                </template>
            </primevue-card>
        </section>
    </main>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';
import AppLayout from '@/layouts/App.vue';
import AvatarEditor from '@/components/ui/avatars/AvatarEditor.vue';
import PrimevueButton from 'primevue/button';
import PrimevueCard from 'primevue/card';

export default {
    layout: AppLayout,

    components: {
        AvatarEditor,
        Head,
        PrimevueButton,
        PrimevueCard,
    },

    props: {
        avatar: {
            type: Object,
            required: true,
        },
    },

    computed: {
        isMyAvatar() {
            return this.avatar.avatarable.type === 'profile'
                && this.$attrs.auth.user.profile.id === this.avatar.avatarable.id;
        },
        pageTitle() {
            return this.isMyAvatar ? 'Update My Avatar' : 'Update Profile Avatar';
        },
    },

    methods: {
        back() {
            window.history.go(-1);
        },
    },
};
</script>
