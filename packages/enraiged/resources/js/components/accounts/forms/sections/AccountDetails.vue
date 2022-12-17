<template>
    <vue-form-section
        v-slot:default="{ fields, heading }"
        :form="form"
        :section="section">
        <primevue-card>
            <template #header>
                <header class="header" v-if="heading">
                    <h3>{{ heading }}</h3>
                </header>
            </template>
            <template #content>
                <section class="formgrid grid">
                    <vue-dropdown-field class="col-6" id="salut" show-clear
                        v-bind="$props" :field="fields.salut"/>
                    <div class="col-6"/>
                    <vue-text-field class="col-6" id="first_name"
                        v-bind="$props" :field="fields.first_name"/>
                    <vue-text-field class="col-6" id="last_name"
                        v-bind="$props" :field="fields.last_name"/>
                    <vue-text-field class="col-6" id="email"
                        v-bind="$props" :field="fields.email"/>
                    <vue-text-field class="col-6" id="alias"
                        v-bind="$props" :field="fields.alias"/>
                    <vue-calendar-field class="col-6" id="birthdate"
                        v-bind="$props" :field="fields.birthdate"/>
                </section>
            </template>
        </primevue-card>
    </vue-form-section>
</template>

<script>
import PrimevueCard from 'primevue/card';
import VueCalendarField from '@/components/forms/fields/CalendarField.vue';
import VueDropdownField from '@/components/forms/fields/DropdownField.vue';
import VueFormSection from '@/components/forms/VueFormSection.vue';
import VueTextField from '@/components/forms/fields/TextField.vue';

export default {
    inheritAttrs: false,

    components: {
        PrimevueCard,
        VueCalendarField,
        VueDropdownField,
        VueFormSection,
        VueTextField,
    },

    props: {
        creating: {
            type: Boolean,
            default: false,
        },
        form: {
            type: Object,
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
