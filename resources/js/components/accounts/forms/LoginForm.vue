<template>
    <primevue-card class="mb-3 max-width-md auto-margin">
        <template #header>
            <header class="border-bluegray-100 border-bottom-1 p-3 surface-200">
                <h3 class="auto-margin max-width-sm">
                    {{ i18n('This form will allow you to manage account login.') }}
                </h3>
            </header>
        </template>
        <template #content>
            <vue-form class="adjacent-labels auto-margin max-width-sm" :builder="builder">
                <template v-slot:default="{ form }">
                    <vue-text-field class="email" id="email"
                        :field="builder.fields.email"
                        :form="form"/>
                    <vue-text-field id="username"
                        :field="builder.fields.username"
                        :form="form"/>
                    <vue-password-field id="password" feedback toggle-mask
                        :field="builder.fields.password"
                        :form="form"/>
                    <vue-password-field id="password_confirmation"
                        :field="builder.fields.password_confirmation"
                        :form="form"/>
                </template>
            </vue-form>
        </template>
    </primevue-card>
</template>

<script>
import AuthenticationDetails from './sections/AuthenticationDetails.vue';
import PrimevueCard from 'primevue/card';
import VueForm from '@/components/forms/VueForm';
import VuePasswordField from '@/components/forms/fields/PasswordField.vue';
import VueTextField from '@/components/forms/fields/TextField.vue';

export default {
    components: {
        AuthenticationDetails,
        PrimevueCard,
        VueForm,
        VuePasswordField,
        VueTextField,
    },

    inject: ['i18n'],

    props: {
        builder: {
            type: Object,
            required: true,
        },
    },
};
</script>
