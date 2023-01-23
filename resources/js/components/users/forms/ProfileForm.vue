<template>
    <primevue-card>
        <template #header>
            <header class="header">
                <h3>{{ i18n('This form will allow you to manage profile details.') }}</h3>
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
import TextField from '@/components/forms/fields/TextField.vue';
import VueForm from '@/components/forms/VueForm.vue';

export default {
    components: {
        PrimevueCard,
        DropdownField,
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
