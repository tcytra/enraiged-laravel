<template>
    <vue-form-section
        v-slot:default="{ fields, heading }"
        :form="form"
        :section="section">
        <section class="personal section">
            <h3 class="h3" v-if="heading">
                {{ heading }}
            </h3>
            <vue-switch-field id="is_active"
                :field="fields.is_active"
                :form="form"/>
            <vue-dropdown-field id="role_id" show-clear
                :field="fields.role_id"
                :form="form"/>
        </section>
    </vue-form-section>
</template>

<script>
import VueDropdownField from '@/components/forms/fields/DropdownField.vue';
import VueFormSection from '@/components/forms/VueFormSection.vue';
import VueSwitchField from '@/components/forms/fields/SwitchField.vue';

export default {
    inheritAttrs: false,

    components: {
        VueDropdownField,
        VueFormSection,
        VueSwitchField,
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
