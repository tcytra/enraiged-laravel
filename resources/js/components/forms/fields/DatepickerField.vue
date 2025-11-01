<template>
    <form-field :field="field" :form="form" :id="id" v-slot:default="field">
        <div class="col-span-full line-break" v-if="field.break">
            <hr :class="field.break" v-if="typeof field.break === 'string'">
            <hr v-else>
        </div>
        <div :class="field.before" v-if="field.before" />
        <div class="control field" v-show="!field.isHidden"
            :class="[$attrs.class, field.class, field.type]">
            <slot name="label" v-bind="field">
                <label class="label" ref="label" :for="field.id" v-if="field.label">
                    {{ field.label }}
                </label>
            </slot>
            <slot name="field" v-bind="field">
                <primevue-datepicker class="datepicker input primevue" ref="input" v-model="field.form[field.id]" fluid
                    :class="[{
                        'has-error': field.error,
                        'is-creating': field.isCreating,
                        'is-updating': field.isUpdating,
                    }, field.width]"
                    :date-format="enableDateFormat"
                    :disabled="field.isDisabled"
                    :disabled-dates="enableDisabledDates"
                    :disabled-days="enableDisabledDays"
                    :hide-on-range-selection="enableHideOnRangeSelection"
                    :input-id="field.id"
                    :inline="enableInline"
                    :invalid="!!field.error"
                    :locale="getActiveLanguage()"
                    :manualInput="enableManualInput"
                    :max-date-count="enableMaximumDateCount"
                    :max-date="enableMaximumDate"
                    :min-date="enableMinimumDate"
                    :number-of-months="enableNumberOfMonths"
                    :placeholder="field.placeholder"
                    :selection-mode="enableSelectionMode"
                    :show-button-bar="enableShowButtonBar"
                    :show-icon="enableShowIcon"
                    :show-time="enableShowTime"
                    :size="field.size"
                    :view="enableView"
                    @clearClick="clear"
                    @update:modelValue="field.update($event)">
                    <template #clearbutton="props">
                        <slot name="clearbutton" v-bind="props" />
                    </template>
                    <template #date="props">
                        <slot name="date" v-bind="props" />
                    </template>
                    <template #inputicon="props">
                        <slot name="inputicon" v-bind="props" />
                    </template>
                </primevue-datepicker>
            </slot>
            <div class="error" v-if="field.error">
                <span class="message">{{ field.error }}</span>
            </div>
        </div>
        <div :class="field.after" v-if="field.after" />
    </form-field>
</template>

<script setup>
import { computed, onMounted, useTemplateRef } from 'vue';
import { getActiveLanguage } from 'laravel-vue-i18n';
import FormField from './renderless/FormField.vue';
import PrimevueDatepicker from 'primevue/datepicker';

const input = useTemplateRef('input');

const props = defineProps({
    autofocus: {
        type: Boolean,
        default: false,
    },
    disableWeekends: {
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
    form: {
        type: Object,
        required: true,
    },
    format: {
        type: String,
        default: null,
    },
    hideOnRangeSelection: {
        type: Boolean,
        default: false,
    },
    id: {
        type: String,
        required: true,
    },
    inline: {
        type: Boolean,
        default: false,
    },
    manualInput: {
        type: Boolean,
        default: false,
    },
    maxDateCount: {
        type: Number,
        default: null,
    },
    maxDate: {
        type: String,
        default: null,
    },
    minDate: {
        type: String,
        default: null,
    },
    multiple: {
        type: Boolean,
        default: false,
    },
    numberOfMonths: {
        type: Number,
        default: null,
    },
    range: {
        type: Boolean,
        default: false,
    },
    showButtonBar: {
        type: Boolean,
        default: false,
    },
    showIcon: {
        type: Boolean,
        default: false,
    },
    showOnFocus: {
        type: Boolean,
        default: false,
    },
    showTime: {
        type: Boolean,
        default: false,
    },
    view: {
        type: String,
        default: null,
    },
});

const clear = () => {
    props.form[props.id] = null;
};

const datepickerView = () => {
    const view = props.view || props.field.view;
    if (['month', 'year'].includes(view)) {
        return view;
    }
    return 'date';
};

const disableDates = () => {
    const disabled = props.disabledDates.length
        ? props.disabledDates
        : props.field.disabledDates || [];
    return disabled.map((date) => newDate(date));
};

const disableDays = () => {
    const disabled = props.disabledDays.length
        ? props.disabledDays
        : props.field.disabledDays || [];
    return props.disableWeekends === true || props.field.disableWeekends === true
        ? [...disabled, 0, 6]
        : disabled;
};

const newDate = (date) => {
    return typeof date === 'string'
        ? new Date(`${date} 00:00:00`)
        : null;
};

const selectionMode = () => {
    if (props.range || props.field.range) {
        return 'range';
    }
    if (props.multiple || props.field.multiple) {
        return 'multiple';
    }
    return 'single';
};

const enableDateFormat = computed(() => props.format || props.field.format || 'MM d, yy');
const enableDisabledDates = computed(() => disableDates());
const enableDisabledDays = computed(() => disableDays());
const enableHideOnRangeSelection = computed(() => props.hideOnRangeSelection === true
    || props.field.hideOnRangeSelection === true);
const enableInline = computed(() => props.inline === true || props.field.inline === true);
const enableManualInput = computed(() => props.manualInput === true || props.field.manualInput === true);
const enableMaximumDateCount = computed(() => props.maxDateCount || props.field.maxDateCount);
const enableMaximumDate = computed(() => newDate(props.maxDate || props.field.maxDate));
const enableMinimumDate = computed(() => newDate(props.minDate || props.field.minDate));
const enableNumberOfMonths = computed(() => props.numberOfMonths || props.field.numberOfMonths);
const enableSelectionMode = computed(() => selectionMode());
const enableShowButtonBar = computed(() => props.showButtonBar === true || props.field.showButtonBar === true);
const enableShowIcon = computed(() => props.showIcon === true || props.field.showIcon === true);
const enableShowTime = computed(() => props.showTime === true || props.field.showTime === true);
const enableView = computed(() => datepickerView());

onMounted(() => {
    if (props.autofocus === true || props.field.autofocus === true) {
        input.value.$el.focus();
    }
});
</script>
