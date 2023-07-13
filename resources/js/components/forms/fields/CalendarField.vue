<template>
    <headless-form-field v-slot:default="{ error, isDirty, isDisabled, isHidden, label, placeholder, update }"
        v-bind="$props">
        <div class="col-12 line-break" v-if="field.break"><hr class=""></div>
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
                    'p-invalid': error,
                }"
                :date-format="field.format || 'yy-mm-dd'"
                :disabled="isDisabled"
                :disabled-dates="field.disabled_dates || disabledDates"
                :disabled-days="field.disabled_days || disabledDays"
                :id="id"
                :placeholder="placeholder"
                :maxDate="maxDate"
                :minDate="minDate"
                :touchUI="isMobile || isTablet"
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
        dirty() {
            const field = this.field.value ? this.field.value.toString() : null;
            const form = this.form[this.id] ? this.form[this.id].toString() : null;
            return field !== form;
        },
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

    methods: {
        newDate(date) {
            return new Date(`${date} 00:00:00`);
        },
    },
};
</script>
