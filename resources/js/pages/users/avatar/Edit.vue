<template>
    <main class="content main">
        <page-header back-button fixed :actions="actions" :title="title"/>
        <section class="auto-margin container max-width-xl">
             <primevue-card class="mb-3 shadow-1">
                <template #header>
                    <header class="header text-lg text-center">
                        <span class="text">
                            {{ i18n('Select a color or upload an image for your avatar.') }}
                        </span>
                    </header>
                </template>
                <template #content>
                    <avatar-editor :avatar="avatar" class="flex align-items-center justify-content-center my-3"/>
                </template>
            </primevue-card>
        </section>
    </main>
</template>

<script>
import App from '@/layouts/App.vue';
import AvatarEditor from '@/components/ui/avatars/AvatarEditor.vue';
import PageHeader from '@/components/ui/pages/PageHeader.vue';
import PrimevueCard from 'primevue/card/Card.vue';

export default {
    layout: App,

    components: {
        AvatarEditor,
        PageHeader,
        PrimevueCard,
    },

    inject: ['i18n'],

    props: {
        actions: {
            type: Array,
            default: [],
        },
        avatar: {
            type: Object,
            required: true,
        },
        user: {
            type: Object,
            required: true,
        },
    },

    computed: {
        title() {
            return this.user.is_myself ? 'Update My Avatar' : 'Update Avatar';
        },
    },
};
</script>
