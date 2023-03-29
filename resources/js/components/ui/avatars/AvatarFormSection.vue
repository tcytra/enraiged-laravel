<template>
    <section>
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
</template>

<script>
import AvatarEditor from '@/components/ui/avatars/AvatarEditor.vue';
import PrimevueCard from 'primevue/card/Card.vue';

export default {
    components: {
        AvatarEditor,
        PrimevueCard,
    },

    inject: ['i18n'],

    props: {
        avatar: {
            type: Object,
            required: true,
        }
    },

    computed: {
    },
};
</script>
