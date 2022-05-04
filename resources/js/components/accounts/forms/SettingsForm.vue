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
            <vue-form class="adjacent-labels auto-margin max-width-sm" ref="settingsForm"
                :builder="builder"
                @form:ready="ready = true">
                <vue-dropdown-field id="timezone" show-clear
                    :field="builder.fields.timezone"
                    :form="settingsForm"/>
            </vue-form>
        </template>
    </primevue-card>
</template>

<script>
import AuthenticationDetails from './sections/AuthenticationDetails.vue';
import PrimevueCard from 'primevue/card';
import VueForm from '@/components/forms/VueForm';
import VueDropdownField from '@/components/forms/fields/DropdownField.vue';

export default {
    components: {
        AuthenticationDetails,
        PrimevueCard,
        VueForm,
        VueDropdownField,
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
        settingsForm() {
            return this.ready ? this.$refs.settingsForm.form : null;
        },
    },
};
</script>
