<template>
    <main class="content main">
        <page-header back-button title="Create Account"/>
        <section class="auto-margin container max-width-lg">
            <primevue-card>
                <template #header>
                    <header class="border-bluegray-100 border-bottom-1 p-3 surface-200">
                        <h3 class="auto-margin max-width-sm">
                            {{ i18n('Please provide the following information to create a new account.') }}
                        </h3>
                    </header>
                </template>
                <template #content>
                    <vue-form class="adjacent-labels auto-margin max-width-sm" :builder="builder">
                        <template v-slot:default="{ form }">
                            <vue-dropdown-field id="role_id" show-clear
                                :field="builder.fields.role_id"
                                :form="form"/>
                            <vue-text-field id="name"
                                :field="builder.fields.name"
                                :form="form"/>
                            <vue-text-field class="email" id="email"
                                :field="builder.fields.email"
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

    inject: ['i18n'],

    props: {
        builder: {
            type: Object,
            required: true,
        },
    },
};
</script>
