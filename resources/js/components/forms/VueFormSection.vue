<template>
    <section class="section">
        <slot :name="id" v-bind="{ creating, section, form, updating }">
            <primevue-card>
                <template #title>
                    <header class="header" v-if="section.heading"
                        :class="[ section.heading.class ]">
                        <span class="text">{{ i18n(section.heading.body || section.heading) }}</span>
                    </header>
                </template>
                <template #content>
                    <div class="precontent mb-3" v-if="section.precontent"
                        :class="[
                            section.precontent.class,
                            section.precontent.severity ? `p-message-${section.precontent.severity}` : ''
                        ]">
                        <primevue-message :severity="section.precontent.severity" v-if="section.precontent.severity">
                            {{ i18n(section.precontent.body || section.precontent) }}
                        </primevue-message>
                        <span v-else>
                            {{ i18n(section.precontent.body || section.precontent) }}
                        </span>
                    </div>
                    <vue-form-fields ref="formfields"
                        :class="section.class"
                        :creating="creating"
                        :fields="section.fields"
                        :form="form"
                        :invalid="error"
                        :template="template"
                        :updating="updating"
                        @field:updated="updated">
                        <template v-for="(_, slot) of $slots" v-slot:[slot]="scope">
                            <slot :name="slot" v-bind="scope" />
                        </template>
                    </vue-form-fields>
                    <div class="postcontent" v-if="section.postcontent"
                        :class="[ section.postcontent.class ]">
                        <primevue-message :severity="section.postcontent.severity" v-if="section.postcontent.severity">
                            {{ i18n(section.postcontent.body || section.postcontent) }}
                        </primevue-message>
                        <span v-else>
                            {{ i18n(section.postcontent.body || section.postcontent) }}
                        </span>
                    </div>
                    <div class="p-message p-message-error error section-error" v-if="error">
                        <div class="p-message-wrapper py-1 px-3">
                            <div class="p-message-text p-message-text">{{ error }}</div>
                        </div>
                    </div>
                </template>
            </primevue-card>
        </slot>
    </section>
</template>

<script>
import { trans as i18n } from 'laravel-vue-i18n';
import PrimevueCard from 'primevue/card';
import PrimevueMessage from 'primevue/message';
import VueFormFields from './VueFormFields.vue';

export default {
    components: {
        PrimevueCard,
        PrimevueMessage,
        VueFormFields,
    },

    emits: ['field:updated'],

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
            required: true,
        },
        section: {
            type: Object,
            required: true,
        },
        template: {
            type: Object,
            required: true,
        },
        updating: {
            type: Boolean,
            default: false,
        },
    },

    computed: {
        class() {
            return typeof section.class !== 'undefined'
                ? section.class
                : null;
        },
        error() {
            return this.form && this.form.errors ? this.form.errors[this.id] : null;
        },
        i18n() {
            return i18n;
        },
    },

    methods: {
        updated(fieldid) {
            this.$emit('field:updated', fieldid, this.id);
        },
    },
};    
</script>
