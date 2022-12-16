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
                    <vue-text-field class="col-6" id="first_name"
                        :field="fields.first_name"
                        :form="form"/>
                    <vue-text-field class="col-6" id="last_name"
                        :field="fields.last_name"
                        :form="form"/>
                    <vue-text-field class="col-12 md:col-10 lg:col-8 xl:col-6" id="email"
                        :field="fields.email"
                        :form="form"/>
                    <vue-dropdown-field class="col-6" id="timezone" show-clear
                        :field="fields.timezone"
                        :form="form"/>
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
        form: {
            type: Object,
            required: true,
        },
        section: {
            type: Object,
            required: true,
        },
    },
};
</script>
