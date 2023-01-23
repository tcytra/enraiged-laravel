<template>
    <primevue-card class="mb-3 max-width-md auto-margin">
        <template #header>
            <header class="header">
                <h3 class="auto-margin max-width-sm">
                    {{ i18n('This form will allow you to manage user login.') }}
                </h3>
            </header>
        </template>
        <template #content>
            <vue-form :template="template"/>
        </template>
    </primevue-card>
</template>

<script>
import PrimevueCard from 'primevue/card/Card.vue';
import PasswordField from '@/components/forms/fields/PasswordField.vue';
import TextField from '@/components/forms/fields/TextField.vue';
import VueForm from '@/components/forms/VueForm.vue';

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
