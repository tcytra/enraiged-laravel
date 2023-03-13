<template>
    <main class="content main">
        <page-header back-button :actions="actions" :title="title"/>
        <section class="auto-margin container max-width-lg">
             <primevue-card class="mb-3 shadow-1">
                <template #header>
                    <header class="header">
                        <h3 class="auto-margin max-width-sm">
                            {{ i18n('Select a color or upload an image for this avatar.') }}
                        </h3>
                    </header>
                </template>
                <template #content>
                    <avatar-editor :avatar="avatar" class="auto-margin width-sm"/>
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
