<template>
    <vue-form-section
        v-slot:default="{ fields, heading }"
        :form="form"
        :section="section">
        <section class="personal section">
            <h3 class="h3" v-if="heading">
                {{ heading }}
            </h3>
            <vue-dropdown-field id="salut" show-clear
                :field="fields.salut"
                :form="form"/>
            <vue-text-field id="first_name"
                :field="fields.first_name"
                :form="form"/>
            <vue-text-field id="last_name"
                :field="fields.last_name"
                :form="form"/>
            <vue-text-field id="alias"
                :field="fields.alias"
                :form="form"/>
            <vue-calendar-field id="birthdate"
                :field="fields.birthdate"
                :form="form"/>
        </section>
    </vue-form-section>
</template>

<script>
import VueCalendarField from '@/components/forms/fields/CalendarField.vue';
import VueDropdownField from '@/components/forms/fields/DropdownField.vue';
import VueFormSection from '@/components/forms/VueFormSection.vue';
import VueTextField from '@/components/forms/fields/TextField.vue';

export default {
    inheritAttrs: false,

    components: {
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
