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
                <div class="formgrid grid mb-3">
                    <theme-form-field ref="themeFormField"
                        :creating="creating"
                        :field="field"
                        :form="form"
                        :id="id"
                        :updating="updating"/>
                </div>
                <div class="postcontent" v-if="section.postcontent"
                    :class="[ section.postcontent.class ]">
                    {{ i18n(section.postcontent.body || section.postcontent) }}
                </div>
            </template>
        </primevue-card>
    </section>
</template>

<script>
import PrimevueCard from 'primevue/card/Card.vue';
import ThemeFormField from '@/components/ui/themes/ThemeFormField.vue';

export default {
    components: {
        PrimevueCard,
        ThemeFormField,
    },

    inject: ['i18n'],

    props: {
        creating: {
            type: Boolean,
            default: false,
        },
        form: {
            type: Object,
            required: true,
        },
        id: {
            type: String,
            default: 'theme',
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
            return this.section.fields[this.id];
        },
    },

    methods: {
        reset() {
            this.$refs.themeFormField.reset();
        },
    },
};
</script>
