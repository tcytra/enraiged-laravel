<template>
    <primevue-card class="mb-3 max-width-md auto-margin">
        <template #header>
            <header class="header">
                <h3 class="auto-margin max-width-sm">
                    {{ i18n('This form will allow you to manage account login.') }}
                </h3>
            </header>
        </template>
        <template #content>
            <vue-form class="auto-margin max-width-sm" :template="template">
                <template v-slot:default="{ form }">
                    <div class="formgrid grid">
                        <text-field class="col-6" id="email"
                            :field="template.fields.email"
                            :form="form"/>
                        <div class="col-6"/>
                        <password-field class="col-6" id="password" feedback toggle-mask
                            :field="template.fields.password"
                            :form="form"/>
                        <password-field class="col-6" id="password_confirmation"
                            :field="template.fields.password_confirmation"
                            :form="form"/>
                    </div>
                </template>
            </vue-form>
        </template>
    </primevue-card>
</template>

<script>
import PrimevueCard from 'primevue/card';
import PasswordField from '@/components/forms/fields/PasswordField.vue';
import TextField from '@/components/forms/fields/TextField.vue';
import VueForm from '@/components/forms/VueForm';

export default {
    components: {
        PrimevueCard,
        PasswordField,
        TextField,
        VueForm,
    },

    inject: ['i18n'],

    props: {
        template: {
            type: Object,
            required: true,
        },
    },
};
</script>
