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
                    :creating="creating"
                    :fields="section.fields"
                    :form="form"
                    :updating="updating">
                    <template v-for="(_, slot) of $slots" v-slot:[slot]="scope">
                        <slot :name="slot" v-bind="scope"/>
                    </template>
                </vue-form-fields>
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
