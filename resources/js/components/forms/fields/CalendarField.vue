<template>
    <headless-form-field v-slot:default="{ dirty, disabled, error, label, placeholder, update }"
        v-bind="$props">
        <div :class="field.before" v-if="field.before"/>
        <div class="control field calendar" v-show="show"
            :class="[$attrs.class, field.class, labels]">
            <label v-if="label" class="label" :for="id">
                {{ label }}
            </label>
            <primevue-calendar class="w-full"
                v-model="form[id]"
                :class="{
                    'is-creating': dirty && creating,
                    'is-updating': dirty && updating,
                    'p-inputtext-lg': isLarge,
                    'p-inputtext-sm': isSmall,
                    'p-invalid': error,
                }"
                :date-format="field.date_format || 'yy-mm-dd'"
                :disabled="disabled"
                :disabled-dates="field.disabled_dates || disabledDates"
                :disabled-days="field.disabled_days || disabledDays"
                :id="id"
                :placeholder="placeholder"
                :maxDate="maxDate"
                :minDate="minDate"
                @update:modelValue="update; $emit('update:modelValue', $event)"/>
            <div class="error p-error" v-if="error">
                <i class="pi pi-exclamation-circle" v-tooltip.top="error"></i>
                <span class="message">{{ error }}</span>
            </div>
        </div>
        <div :class="field.after" v-if="field.after"/>
    </headless-form-field>
</template>

<script>
import HeadlessFormField from '@/components/forms/headless/FormField.vue';
import PrimevueCalendar from 'primevue/calendar/Calendar.vue';
import PrimevueTooltip from 'primevue/tooltip/tooltip.cjs.js';

export default {
    inheritAttrs: false,

    components: {
        HeadlessFormField,
        PrimevueCalendar,
    },

    directives: {
        tooltip: PrimevueTooltip,
    },

    inject: ['newDate'],

    props: {
        creating: {
            type: Boolean,
            default: false,
        },
        disabledDates: {
            type: Array,
            default: [],
        },
        disabledDays: {
            type: Array,
            default: [],
        },
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
        labels: {
            type: String,
            default: null,
        },
        show: {
            type: Boolean,
            default: true,
        },
        updating: {
            type: Boolean,
            default: false,
        },
    },

    computed: {
        maxDate() {
            return this.field.maximum
                ? this.newDate(this.field.maximum)
                : null;
        },
        minDate() {
            return this.field.minimum
                ? this.newDate(this.field.minimum)
                : null;
        },
    },
};
</script>
