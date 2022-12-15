<template>
    <vue-form-field v-slot:default="{ error, label, update }"
        :field="field"
        :form="form"
        :id="id">
        <div class="control field switch" v-show="show"
            :class="[
                $attrs.class,
                field.class,
                labels,
                { 'switch-first': switchFirst },
            ]">
            <label v-if="label" class="label" :for="id">
                {{ label }}
            </label>
            <primevue-switch v-model="model" :id="id"
                @change="$emit('change')"
                @update:modelValue="update"/>
            <div class="error p-error" v-if="error">
                <i class="pi pi-exclamation-circle" v-tooltip.top="error"></i>
                <span class="message">{{ error }}</span>
            </div>
        </div>
    </vue-form-field>
</template>

<script>
import { v4 as uuid } from 'uuid';
import PrimevueSwitch from 'primevue/inputswitch';
import PrimevueTooltip from 'primevue/tooltip';
import VueFormField from '@/components/forms/VueFormField';

export default {
    inheritAttrs: false,

    components: {
        PrimevueSwitch,
        VueFormField,
    },

    directives: {
        tooltip: PrimevueTooltip,
    },

    props: {
        field: {
            type: Object,
            required: true,
        },
        form: {
            type: Object,
            required: true,
        },
        id: {
            type: String,
            required: true,
        },
        labels: {
            type: String,
            default: null,
        },
        show: {
            type: Boolean,
            default: true,
        },
        switchFirst: {
            type: Boolean,
            default: false,
        },
    },

    computed: {
        model() {
            return this.form ? this.form[this.id] : null;
        },
    },
};
</script>
