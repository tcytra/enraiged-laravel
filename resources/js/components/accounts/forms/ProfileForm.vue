<template>
    <primevue-card>
        <template #header>
            <header class="border-bluegray-100 border-bottom-1 p-3 surface-200">
                <h3 class="auto-margin max-width-sm">
                    This form will allow you to manage profile details.
                </h3>
            </header>
        </template>
        <template #content>
            <vue-form class="adjacent-labels auto-margin max-width-sm" ref="profileForm"
                :builder="builder"
                @form:ready="ready = true">
                <section class="section" v-if="ready">
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
                </section>
            </vue-form>
        </template>
    </primevue-card>
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
