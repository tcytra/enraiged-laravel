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
                    <vue-password-field class="col-6" id="password" feedback toggle-mask
                        v-bind="$props" :field="fields.password"/>
                    <vue-password-field class="col-6" id="password_confirmation"
                        v-bind="$props" :field="fields.password_confirmation"/>
                </section>
            </template>
        </primevue-card>
    </vue-form-section>
</template>

<script>
import PrimevueCard from 'primevue/card';
import VueFormSection from '@/components/forms/VueFormSection.vue';
import VuePasswordField from '@/components/forms/fields/PasswordField.vue';
import VueTextField from '@/components/forms/fields/TextField.vue';

export default {
    inheritAttrs: false,

    components: {
        PrimevueCard,
        VueFormSection,
        VuePasswordField,
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
