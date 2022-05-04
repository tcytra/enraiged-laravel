<template>
    <primevue-card class="mb-3 max-width-md auto-margin">
        <template #header>
            <header class="border-bluegray-100 border-bottom-1 p-3 surface-200">
                <h3 class="auto-margin max-width-sm">
                    This form will allow you to manage account login credentials.
                </h3>
            </header>
        </template>
        <template #content>
            <vue-form class="adjacent-labels auto-margin max-width-sm" ref="loginForm"
                :builder="builder"
                @form:ready="ready = true">
                <div v-if="ready">
                    <vue-text-field class="email" id="email"
                        :field="builder.fields.email"
                        :form="loginForm"/>
                    <vue-text-field id="username"
                        :field="builder.fields.username"
                        :form="loginForm"/>
                    <vue-password-field id="password" feedback toggle-mask
                        :field="builder.fields.password"
                        :form="loginForm"/>
                    <vue-password-field id="password_confirmation"
                        :field="builder.fields.password_confirmation"
                        :form="loginForm"/>
                </div>
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

    props: {
        builder: {
            type: Object,
            required: true,
        },
    },

    data: () => ({
        ready: false,
    }),

    computed: {
        loginForm() {
            return this.ready ? this.$refs.loginForm.form : null;
        },
    },
};
</script>
