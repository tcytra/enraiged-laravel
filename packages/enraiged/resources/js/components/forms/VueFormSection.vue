<template>
    <section class="section" :class="section.class">
        <slot :name="id" v-if="section.custom"/>
        <primevue-card v-else>
            <template #header>
                <header class="header" v-if="section.heading">
                    <h3>{{ i18n(section.heading) }}</h3>
                </header>
            </template>
            <template #content>
                <vue-form-fields
                    :creating="creating"
                    :fields="section.fields"
                    :form="form"
                    :updating="updating"/>
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
        updating: {
            type: Boolean,
            default: false,
        },
    },
};    
</script>
