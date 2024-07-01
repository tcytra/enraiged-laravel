<template>
    <headless-form-field v-slot:default="{ error, isDirty, isDisabled, isHidden, label, placeholder, update }"
        v-bind="$props">
        <div class="col-12 line-break" v-if="field.break">
            <hr :class="field.break" v-if="typeof field.break === 'string'">
            <hr v-else>
        </div>
        <div :class="field.before" v-if="field.before"/>
        <div class="control field calendar" v-show="show && !isHidden"
            :class="[$attrs.class, field.class]">
            <label v-if="label" class="label" :for="id">
                {{ label }}
            </label>
            <primevue-calendar class="w-full" ref="field"
                v-model="form[id]"
                :class="{
                    'is-creating': isDirty && creating,
                    'is-updating': isDirty && updating,
                    'p-inputtext-lg': isLarge,
                    'p-inputtext-sm': isSmall,
                    'p-invalid': invalid || error,
                }"
                :date-format="usingDateFormat"
                :disabled="isDisabled"
                :disabled-dates="usingDisabledDates"
                :disabled-days="usingDisabledDays"
                :hide-on-range-selection="enableHideOnRangeSelection"
                :id="id"
                :placeholder="placeholder"
                :max-date="usingMaximumDate"
                :min-date="usingMinimumDate"
                :number-of-months="numberOfMonths || field.numberOfMonths"
                :selection-mode="selectionMode || field.selectionMode"
                :touchUI="touchUI || field.touchUI || (isMobile || isTablet)"
                @update:modelValue="update(); $emit('update:modelValue', $event)"/>
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
import PrimevueTooltip from 'primevue/tooltip/tooltip.esm.js';

export default {
    inheritAttrs: false,

    components: {
        HeadlessFormField,
        PrimevueCalendar,
    },

    directives: {
        tooltip: PrimevueTooltip,
    },

    inject: ['isMobile', 'isTablet'],

    props: {
        creating: {
            type: Boolean,
            default: false,
        },
        disabled: {
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
        hideOnRangeSelection: {
            type: Boolean,
            required: false,
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
        invalid: {
            type: Boolean,
            default: false,
        },
        maxDate: {
            type: String,
            required: false,
        },
        minDate: {
            type: String,
            required: false,
        },
        numberOfMonths: {
            type: Number,
            required: false,
        },
        selectionMode: {
            type: String,
            required: false,
        },
        show: {
            type: Boolean,
            default: true,
        },
        touchUI: {
            type: Boolean,
            required: false,
        },
        updating: {
            type: Boolean,
            default: false,
        },
    },

    computed: {
        dirty() {
            const field = this.field.value ? this.field.value.toString() : null;
            const form = this.form[this.id] ? this.form[this.id].toString() : null;
            return field !== form;
        },
        enableHideOnRangeSelection() {
            return this.hideOnRangeSelection === true
                || this.field.hideOnRangeSelection === true;
        },
        usingDateFormat() {
            return this.field.format || this.field.dateFormat || 'yy-mm-dd';
        },
        usingDisabledDates() {
            const disabled = this.disabledDates.length
                ? this.disabledDates
                : this.field.disabledDates || [];
            return disabled.map((date) => this.newDate(date));
        },
        usingDisabledDays() {
            return this.disabledDays.length
                ? this.disabledDays
                : this.field.disabledDays || [];
        },
        usingMaximumDate() {
            const maxDate = this.maxDate || this.field.maxDate;
            return typeof maxDate === 'string'
                ? this.newDate(maxDate)
                : null;
        },
        usingMinimumDate() {
            const minDate = this.minDate || this.field.minDate;
            return typeof minDate === 'string'
                ? this.newDate(minDate)
                : null;
        },
    },

    methods: {
        newDate(date) {
            return new Date(`${date} 00:00:00`);
        },
    },
};
</script>
