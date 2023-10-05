<template>
    <section :class="section.class">
        <primevue-card>
            <template #header>
                <header class="header" v-if="section.heading"
                    :class="[ section.heading.class ]">
                    <span class="text w-full">{{ i18n(section.heading.body || section.heading) }}</span>
                </header>
            </template>
            <template #content>
                <div class="precontent mb-3" v-if="section.precontent"
                    :class="[ section.precontent.class ]">
                    {{ i18n(section.precontent.body || section.precontent) }}
                </div>
                <avatar-editor :avatar="avatar" :class="field ? field.class : null"/>
                <div class="postcontent" v-if="section.postcontent"
                    :class="[ section.postcontent.class ]">
                    {{ i18n(section.postcontent.body || section.postcontent) }}
                </div>
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
        },
        creating: {
            type: Boolean,
            default: false,
        },
        section: {
            type: Object,
            required: true,
        },
        updating: {
            type: Boolean,
            default: false,
        },
    },

    computed: {
        field() {
            return this.section.fields['avatar'];
        },
    },
};
</script>
