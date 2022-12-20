<template>
    <primevue-card>
        <template #header>
            <header class="header">
                <h3 class="auto-margin max-width-sm">
                    {{ i18n('This form will allow you to manage profile details.') }}
                </h3>
            </header>
        </template>
        <template #content>
            <vue-form class="auto-margin max-width-sm" :template="template">
                <template v-slot:default="{ form }">
                    <div class="formgrid grid">
                        <dropdown-field class="col-6" id="salut" show-clear
                            :field="template.fields.salut"
                            :form="form"/>
                        <div class="col-9"/>
                        <text-field class="col-6" id="first_name"
                            :field="template.fields.first_name"
                            :form="form"/>
                        <text-field class="col-6" id="last_name"
                            :field="template.fields.last_name"
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
import TextField from '@/components/forms/fields/TextField.vue';
import VueForm from '@/components/forms/VueForm';

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
