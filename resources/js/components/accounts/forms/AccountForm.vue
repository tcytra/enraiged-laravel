<template>
    <primevue-card>
        <template #header>
            <header class="border-bluegray-100 border-bottom-1 p-3 surface-200">
                <h3 class="auto-margin max-width-sm">
                    This form will allow you to manage account and profile details.
                </h3>
            </header>
        </template>
        <template #content>
            <vue-form class="adjacent-labels auto-margin max-width-sm" ref="accountForm"
                :builder="builder"
                @form:ready="ready = true">
                <administrative-options v-if="administrativeOptions"
                    :form="accountForm"
                    :section="administrativeOptions"/>
                <personal-information
                    :form="accountForm"
                    :section="personalInformation"/>
                <authentication-details
                    :form="accountForm"
                    :section="authenticationDetails"/>
            </vue-form>
        </template>
    </primevue-card>
</template>

<script>
import AdministrativeOptions from './sections/AdministrativeOptions.vue';
import AuthenticationDetails from './sections/AuthenticationDetails.vue';
import PersonalInformation from './sections/PersonalInformation.vue';
import PrimevueCard from 'primevue/card';
import VueForm from '@/components/forms/VueForm';

export default {
    components: {
        AdministrativeOptions,
        AuthenticationDetails,
        PersonalInformation,
        PrimevueCard,
        VueForm,
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
        accountForm() {
            return this.ready ? this.$refs.accountForm.form : null;
        },
        administrativeOptions() {
            return this.builder.fields.administration;
        },
        authenticationDetails() {
            return this.builder.fields.authentication;
        },
        personalInformation() {
            return this.builder.fields.personal;
        },
    },
};
</script>
