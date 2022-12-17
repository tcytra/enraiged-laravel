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
                <section class="flex justify-content-between">
                    <vue-switch-field class="col-4" id="is_active"
                        v-bind="$props" :field="fields.is_active"/>
                    <vue-dropdown-field class="col-4" id="role_id" show-clear
                        v-bind="$props" :field="fields.role_id"/>
                </section>
            </template>
        </primevue-card>
    </vue-form-section>
</template>

<script>
import PrimevueCard from 'primevue/card';
import VueDropdownField from '@/components/forms/fields/DropdownField.vue';
import VueFormSection from '@/components/forms/VueFormSection.vue';
import VueSwitchField from '@/components/forms/fields/SwitchField.vue';

export default {
    inheritAttrs: false,

    components: {
        PrimevueCard,
        VueDropdownField,
        VueFormSection,
        VueSwitchField,
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
