<template>
    <primevue-card>
        <template #content>
            <vue-form class="adjacent-labels auto-margin max-width-sm" ref="accountForm"
                :builder="builder"
                @form:ready="ready = true">
                <div v-if="ready">
                    <administrative-options v-if="administrativeOptions"
                        :form="accountForm"
                        :section="administrativeOptions"/>
                    <personal-information
                        :form="accountForm"
                        :section="personalInformation"/>
                    <authentication-details
                        :form="accountForm"
                        :section="authenticationDetails"/>
                </div>
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
