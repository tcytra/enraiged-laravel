<template>
    <div class="login-form adjacent-labels">
        <primevue-card class="mb-3 max-width-md auto-margin">
            <template #content>
                <vue-form class="max-width-sm auto-margin" ref="profileForm"
                    :builder="builder"
                    @form:ready="ready = true">
                    <div v-if="ready">
                        <vue-dropdown-field id="salut" show-clear
                            :field="builder.fields.salut"
                            :form="profileForm"/>
                        <vue-text-field id="first_name"
                            :field="builder.fields.first_name"
                            :form="profileForm"/>
                        <vue-text-field id="last_name"
                            :field="builder.fields.last_name"
                            :form="profileForm"/>
                        <vue-text-field id="alias"
                            :field="builder.fields.alias"
                            :form="profileForm"/>
                        <vue-calendar-field id="birthdate"
                            :field="builder.fields.birthdate"
                            :form="profileForm"/>
                    </div>
                </vue-form>
            </template>
        </primevue-card>
    </div>
</template>

<script>
import AuthenticationDetails from './sections/AuthenticationDetails.vue';
import PrimevueCard from 'primevue/card';
import VueCalendarField from '@/components/forms/fields/CalendarField.vue';
import VueDropdownField from '@/components/forms/fields/DropdownField.vue';
import VueForm from '@/components/forms/VueForm';
import VueTextField from '@/components/forms/fields/TextField.vue';

export default {
    components: {
        AuthenticationDetails,
        PrimevueCard,
        VueCalendarField,
        VueDropdownField,
        VueForm,
        VueTextField,
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
        profileForm() {
            return this.ready ? this.$refs.profileForm.form : null;
        },
    },
};
</script>
