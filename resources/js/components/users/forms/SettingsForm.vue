<template>
    <primevue-card class="mb-3 max-width-md auto-margin">
        <template #header>
            <header class="header">
                <h3>{{ i18n('This form will allow you to manage user settings.') }}</h3>
            </header>
        </template>
        <template #content>
            <vue-form :template="template"/>
        </template>
    </primevue-card>
</template>

<script>
import PrimevueCard from 'primevue/card/Card.vue';
import DropdownField from '@/components/forms/fields/DropdownField.vue';
import SwitchField from '@/components/forms/fields/SwitchField.vue';
import VueForm from '@/components/forms/VueForm.vue';

export default {
    components: {
        PrimevueCard,
        DropdownField,
        SwitchField,
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
