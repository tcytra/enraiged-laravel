<template>
    <div class="login-form adjacent-labels">
        <primevue-card class="mb-3 max-width-md auto-margin">
            <template #content>
                <vue-form class="max-width-sm auto-margin" ref="loginForm"
                    :builder="builder"
                    @form:ready="ready = true"
                    @form:submit="submit">
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
                </vue-form>
            </template>
        </primevue-card>
    </div>
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
