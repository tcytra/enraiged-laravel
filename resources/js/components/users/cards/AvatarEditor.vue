<template>
    <primevue-card class="mb-3 shadow-1">
        <template #header>
            <header class="header text-center text-lg">
                <span class="text">
                    {{ i18n('Update Avatar') }}
                </span>
            </header>
        </template>
        <template #content>
            <avatar-editor class="flex align-items-center justify-content-center my-3"
                :avatar="avatar"/>
        </template>
    </primevue-card>
</template>

<script>
import AvatarEditor from '@/components/ui/avatars/AvatarEditor.vue';
import PrimevueCard from 'primevue/card';

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
        },
    },
};
</script>
