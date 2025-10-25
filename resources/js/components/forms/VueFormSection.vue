<template>
    <section class="section" :class="section.class">
        <slot :name="id" v-if="section.custom" v-bind="{ creating, section, form, updating }"/>
        <primevue-card v-else>
            <template #header>
                <header class="header" v-if="section.heading"
                    :class="[ section.heading.class ]">
                    <span class="text">{{ i18n(section.heading.body || section.heading) }}</span>
                </header>
            </template>
            <template #content>
                <div class="precontent mb-3" v-if="section.precontent"
                    :class="[ section.precontent.class ]">
                    {{ i18n(section.precontent.body || section.precontent) }}
                </div>
                <vue-form-fields
                    :class="section.class"
                    :creating="creating"
                    :fields="section.fields"
                    :form="form"
                    :invalid="error"
                    :template="template"
                    :updating="updating">
                    <template v-for="(_, slot) of $slots" v-slot:[slot]="scope">
                        <slot :name="slot" v-bind="scope"/>
                    </template>
                </vue-form-fields>
                <div class="postcontent" v-if="section.postcontent"
                    :class="[ section.postcontent.class ]">
                    {{ i18n(section.postcontent.body || section.postcontent) }}
                </div>
                <div class="p-message p-message-error error section-error" v-if="error">
                    <div class="p-message-wrapper py-1 px-3">
                        <div class="p-message-text p-message-text">{{ error }}</div>
                    </div>
                </div>
            </template>
        </primevue-card>
    </section>
</template>

<script>
import PrimevueCard from 'primevue/card';
import VueFormFields from './VueFormFields.vue';

export default {
    components: {
        PrimevueCard,
        VueFormFields,
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
    },
};    
</script>
