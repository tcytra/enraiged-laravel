<template>
    <vue-form ref="form"
        :builder="builder">
        <template v-slot:default="{ form }">
            <administrative-options v-if="builder.fields.administration"
                :form="form"
                :section="builder.fields.administration"/>
            <account-details
                :form="form"
                :section="builder.fields.personal"/>
            <account-password
                :form="form"
                :section="builder.fields.authentication"/>
        </template>
    </vue-form>
</template>

<script>
import AdministrativeOptions from './sections/AdministrativeOptions.vue';
import AccountDetails from './sections/AccountDetails.vue';
import AccountPassword from './sections/AccountPassword.vue';
import VueForm from '@/components/forms/VueForm';

export default {
    components: {
        AdministrativeOptions,
        AccountDetails,
        AccountPassword,
        VueForm,
    },

    inject: ['i18n'],

    props: {
        creating: {
            type: Boolean,
            default: false,
        },
        builder: {
            type: Object,
            required: true,
        },
        updating: {
            type: Boolean,
            default: false,
        },
    },
};
</script>
