<template>
    <Head title="Create Account" />
    <main class="accounts create content main">
        <header class="header">
            <h1>Create Account</h1>
        </header>
        <section class="container">
            <div class="account-form adjacent-labels">
                <primevue-card class="mb-3 max-width-md auto-margin">
                    <template #content>
                        <vue-form class="max-width-sm auto-margin" ref="accountForm"
                            :builder="builder"
                            @form:ready="ready = true"
                            @form:submit="submit">
                            <section class="section">
                                <h3 class="h3 text-center mb-5">
                                    Please provide the following information to create an account.
                                </h3>
                                <vue-dropdown-field id="role_id" show-clear
                                    :field="fields.role_id"
                                    :form="form"/>
                                <vue-text-field id="name"
                                    :field="fields.name"
                                    :form="form"/>
                                <vue-text-field class="email" id="email"
                                    :field="fields.email"
                                    :form="form"/>
                                <vue-password-field id="password" feedback toggle-mask
                                    :field="fields.password"
                                    :form="form"/>
                                <vue-password-field id="password_confirmation"
                                    :field="fields.password_confirmation"
                                    :form="form"/>
                            </section>
                        </vue-form>
                    </template>
                </primevue-card>
            </div>
        </section>
    </main>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';
import AppLayout from '@/layouts/App.vue';
import PrimevueCard from 'primevue/card';
import VueDropdownField from '@/components/forms/fields/DropdownField.vue';
import VueForm from '@/components/forms/VueForm';
import VuePasswordField from '@/components/forms/fields/PasswordField.vue';
import VueTextField from '@/components/forms/fields/TextField.vue';

export default {
    layout: AppLayout,

    components: {
        Head,
        PrimevueCard,
        VueDropdownField,
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
        fields() {
            return this.builder.fields;
        },
        form() {
            return this.ready ? this.$refs.accountForm.form : null;
        },
    },
};
</script>
