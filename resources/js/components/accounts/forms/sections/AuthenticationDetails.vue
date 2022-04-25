<template>
    <vue-form-section
        v-slot:default="{ fields, heading }"
        :form="form"
        :section="section">
        <section class="personal section">
            <h3 class="h3" v-if="heading">
                {{ heading }}
            </h3>
            <vue-text-field class="email" id="email"
                :field="fields.email"
                :form="form"/>
            <vue-text-field id="username"
                :field="fields.username"
                :form="form"/>
            <vue-password-field id="password" feedback toggle-mask
                :field="fields.password"
                :form="form"/>
            <vue-password-field id="password_confirmation"
                :field="fields.password_confirmation"
                :form="form"/>
        </section>
    </vue-form-section>
</template>

<script>
import VueFormSection from '@/components/forms/VueFormSection.vue';
import VuePasswordField from '@/components/forms/fields/PasswordField.vue';
import VueTextField from '@/components/forms/fields/TextField.vue';

export default {
    inheritAttrs: false,

    components: {
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
