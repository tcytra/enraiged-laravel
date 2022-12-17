<template>
    <primevue-card class="mb-3 max-width-md auto-margin">
        <template #header>
            <header class="header">
                <h3 class="auto-margin max-width-sm">
                    {{ i18n('This form will allow you to manage account settings.') }}
                </h3>
            </header>
        </template>
        <template #content>
            <vue-form class="adjacent-labels auto-margin max-width-sm" :builder="builder" @form:success="success">
                <template v-slot:default="{ form }">
                    <vue-dropdown-field id="language" show-clear
                        :field="builder.fields.language"
                        :form="form"/>
                    <vue-dropdown-field id="timezone" show-clear
                        :field="builder.fields.timezone"
                        :form="form"/>
                    <vue-dropdown-field id="dateformat" show-clear
                        :field="builder.fields.dateformat"
                        :form="form"/>
                    <vue-switch-field id="military_time"
                        :field="builder.fields.military_time"
                        :form="form"/>
                </template>
            </vue-form>
        </template>
    </primevue-card>
</template>

<script>
import PrimevueCard from 'primevue/card';
import VueForm from '@/components/forms/VueForm';
import VueDropdownField from '@/components/forms/fields/DropdownField.vue';
import VueSwitchField from '@/components/forms/fields/SwitchField.vue';

export default {
    components: {
        PrimevueCard,
        VueForm,
        VueDropdownField,
        VueSwitchField,
    },

    inject: ['i18n', 'loadAppState'],

    props: {
        builder: {
            type: Object,
            required: true,
        },
    },

    methods: {
        success(form) {
            this.$root.$i18n.locale = form.language;
            this.loadAppState();
        },
    },
};
</script>
