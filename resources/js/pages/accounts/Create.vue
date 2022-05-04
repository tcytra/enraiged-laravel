<template>
    <main class="content main">
        <page-header back-button title="Create Account"/>
        <section class="auto-margin container max-width-md">
            <primevue-card>
                <template #content>
                    <vue-form class="adjacent-labels auto-margin max-width-sm" ref="accountForm"
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
        </section>
    </main>
</template>

<script>
import AppLayout from '@/layouts/App.vue';
import PageHeader from '@/components/ui/pages/PageHeader.vue';
import PrimevueCard from 'primevue/card';
import VueDropdownField from '@/components/forms/fields/DropdownField.vue';
import VueForm from '@/components/forms/VueForm';
import VuePasswordField from '@/components/forms/fields/PasswordField.vue';
import VueTextField from '@/components/forms/fields/TextField.vue';

export default {
    layout: AppLayout,

    components: {
        PageHeader,
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
