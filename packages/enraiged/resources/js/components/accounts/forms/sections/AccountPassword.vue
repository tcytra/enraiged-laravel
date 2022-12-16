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
                        :field="fields.password"
                        :form="form"/>
                    <vue-password-field class="col-6" id="password_confirmation"
                        :field="fields.password_confirmation"
                        :form="form"/>
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
