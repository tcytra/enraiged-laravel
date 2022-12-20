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
            <vue-form class="auto-margin max-width-sm" :template="template" @form:success="success">
                <template v-slot:default="{ form }">
                    <div class="formgrid grid">
                        <dropdown-field class="col-6" id="language" show-clear
                            :field="template.fields.language"
                            :form="form"/>
                        <dropdown-field class="col-6" id="timezone" show-clear
                            :field="template.fields.timezone"
                            :form="form"/>
                        <dropdown-field class="col-6" id="dateformat" show-clear
                            :field="template.fields.dateformat"
                            :form="form"/>
                        <switch-field class="col-6" id="military_time"
                            :field="template.fields.military_time"
                            :form="form"/>
                    </div>
                </template>
            </vue-form>
        </template>
    </primevue-card>
</template>

<script>
import PrimevueCard from 'primevue/card';
import DropdownField from '@/components/forms/fields/DropdownField.vue';
import SwitchField from '@/components/forms/fields/SwitchField.vue';
import VueForm from '@/components/forms/VueForm';

export default {
    components: {
        PrimevueCard,
        DropdownField,
        SwitchField,
        VueForm,
    },

    inject: ['i18n', 'loadAppState'],

    props: {
        template: {
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
