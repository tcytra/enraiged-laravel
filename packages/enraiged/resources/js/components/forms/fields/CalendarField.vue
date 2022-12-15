<template>
    <vue-form-field v-slot:default="{ disabled, error, label, placeholder, update }"
        :field="field"
        :form="form"
        :id="id">
        <div class="control field calendar" v-show="show"
            :class="[$attrs.class, field.class, labels]">
            <label v-if="label" class="label" :for="id">
                {{ label }}
            </label>
            <primevue-calendar
                v-model="model"
                :class="{ 'p-inputtext-lg': isLarge, 'p-inputtext-sm': isSmall, 'p-invalid': error }"
                :date-format="field.date_format || 'yy-mm-dd'"
                :disabled="disabled"
                :id="id"
                :placeholder="placeholder"
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
import PrimevueCalendar from 'primevue/calendar';
import PrimevueTooltip from 'primevue/tooltip';
import VueFormField from '@/components/forms/VueFormField';

export default {
    inheritAttrs: false,

    components: {
        PrimevueCalendar,
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
        focus: {
            type: Boolean,
            default: false,
        },
        form: {
            type: Object,
            required: true,
        },
        id: {
            type: String,
            required: true,
        },
        isLarge: {
            type: Boolean,
            default: false,
        },
        isSmall: {
            type: Boolean,
            default: false,
        },
        show: {
            type: Boolean,
            default: true,
        },
    },

    computed: {
        model() {
            return this.form ? this.form[this.id] : null;
        },
    },
};
</script>
