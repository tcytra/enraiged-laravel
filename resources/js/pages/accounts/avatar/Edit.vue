<template>
    <main class="content main">
        <page-header back-button :title="title"/>
        <section class="auto-margin container max-width-lg">
             <primevue-card class="mb-3">
                <template #header>
                    <header class="border-bluegray-100 border-bottom-1 p-3 surface-200">
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
import AppLayout from '@/layouts/App.vue';
import AvatarEditor from '@/components/ui/avatars/AvatarEditor.vue';
import PageHeader from '@/components/ui/pages/PageHeader.vue';
import PrimevueCard from 'primevue/card';

export default {
    layout: AppLayout,

    components: {
        AvatarEditor,
        PageHeader,
        PrimevueCard,
    },

    inject: ['i18n'],

    props: {
        account: {
            type: Object,
            required: true,
        },
        avatar: {
            type: Object,
            required: true,
        },
    },

    computed: {
        title() {
            return this.account.is_myself ? 'My Avatar' : 'Update Avatar';
        },
    },
};
</script>
