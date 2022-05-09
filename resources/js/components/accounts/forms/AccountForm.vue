<template>
    <primevue-card>
        <template #header>
            <header class="border-bluegray-100 border-bottom-1 p-3 surface-200">
                <h3 class="auto-margin max-width-sm">
                    {{ i18n('This form will allow you to manage account details.') }}
                </h3>
            </header>
        </template>
        <template #content>
            <vue-form class="adjacent-labels auto-margin max-width-sm" :builder="builder">
                <template v-slot:default="{ form }">
                    <administrative-options v-if="builder.fields.administration"
                        :form="form"
                        :section="builder.fields.administration"/>
                    <personal-information
                        :form="form"
                        :section="builder.fields.personal"/>
                    <authentication-details
                        :form="form"
                        :section="builder.fields.authentication"/>
                </template>
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

    inject: ['i18n'],

    props: {
        builder: {
            type: Object,
            required: true,
        },
    },
};
</script>
