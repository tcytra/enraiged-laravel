<template>
    <form-field :field="field" v-slot:default="field">
        <div class="col-12 line-break" v-if="field.break">
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
                <primevue-inputnumber class="input primevue number" ref="input" v-model="field.form[field.id]"
                    :button-layout="enableButtonLayout"
                    :class="[{
                        'has-error': field.error,
                        'is-creating': field.isCreating,
                        'is-updating': field.isUpdating,
                    }, field.width]"
                    :currency="enableFieldCurrency"
                    :disabled="field.isDisabled"
                    :input-id="field.id"
                    :invalid="!!field.error"
                    :locale="getActiveLanguage()"
                    :max="enableMaximumFieldValue"
                    :min="enableMinimumFieldValue"
                    :min-fraction-digits="enableMinimumFractionDigits"
                    :mode="enableFieldMode"
                    :placeholder="field.placeholder"
                    :prefix="enablePrefix"
                    :show-buttons="enableButtons"
                    :step="enableIncrementStep"
                    :suffix="enableSuffix"
                    :size="field.size"
                    @update:modelValue="field.update($event)">
                    <template #incrementbuttonicon>
                        <slot name="incrementbuttonicon" />
                    </template>
                    <template #decrementbuttonicon>
                        <slot name="incrementbuttonicon" />
                    </template>
                </primevue-inputnumber>
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
import PrimevueInputnumber from 'primevue/inputnumber';

const input = useTemplateRef('input');

const props = defineProps({
    autofocus: {
        type: Boolean,
        default: false,
    },
    buttonLayout: {
        type: String,
        default: null,
    },
    currency: {
        type: String,
        default: null,
    },
    field: {
        type: Object,
        required: true,
    },
    max: {
        type: Number,
        default: null,
    },
    min: {
        type: Number,
        default: null,
    },
    minFractionDigits: {
        type: Number,
        default: null,
    },
    mode: {
        type: String,
        default: null,
    },
    prefix: {
        type: String,
        default: null,
    },
    showButtons: {
        type: Boolean,
        default: false,
    },
    step: {
        type: Number,
        default: null,
    },
    suffix: {
        type: String,
        default: null,
    },
});

const buttonLayout = () => {
    const layout = props.buttonLayout || props.field.buttonLayout;
    if (['horizontal', 'vertical'].includes(layout)) {
        return layout;
    }
    return null;
};

const incrementStep = () => {
    const step = props.step || props.field.step;
    return !isNaN(step)
        ? step
        : null;
};

const maximumFieldValue = () => {
    const value = props.max || props.field.max;
    return !isNaN(value)
        ? value
        : null;
};

const minimumFieldValue = () => {
    const value = props.min || props.field.min;
    return !isNaN(value)
        ? value
        : null;
};

const minimumFractionDigits = () => {
    const digits = props.minFractionDigits || props.field.minFractionDigits;
    return !isNaN(digits)
        ? digits
        : 0;
};

const enableButtons = computed(() => props.showButtons === true || props.field.showButtons === true);
const enableButtonLayout = computed(() => buttonLayout());
const enableFieldCurrency = computed(() => props.currency || props.field.currency || 'USD');
const enableFieldMode = computed(() => props.mode || props.field.mode || null);
const enableIncrementStep = computed(() => incrementStep());
const enableMaximumFieldValue = computed(() => maximumFieldValue());
const enableMinimumFieldValue = computed(() => minimumFieldValue());
const enableMinimumFractionDigits = computed(() => minimumFractionDigits());
const enablePrefix = computed(() => props.prefix || props.field.prefix || null);
const enableSuffix = computed(() => props.suffix || props.field.suffix || null);

onMounted(() => {
    if (props.autofocus === true || props.field.autofocus === true) {
        input.value.$el.focus();
    }
});
</script>
