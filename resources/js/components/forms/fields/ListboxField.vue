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
                <primevue-listbox class="input primevue listbox" ref="input" v-model="field.form[field.id]"
                    :class="[{
                        'has-error': field.error,
                        'is-creating': field.isCreating,
                        'is-updating': field.isUpdating,
                    }, field.width]"
                    :checkmark="enableCheckmark"
                    :disabled="field.isDisabled"
                    :filter="enableFilter"
                    :highlight-on-select="!disableHighlightOnSelect"
                    :input-id="field.id"
                    :invalid="!!field.error"
                    :multiple="enableMultiple"
                    :option-label="enableOptionLabel"
                    :option-value="enableOptionValue"
                    :options="options"
                    :placeholder="field.placeholder"
                    :size="field.size"
                    :virtual-scroller-options="enableVirtualScrollerOptions"
                    @update:modelValue="field.update($event)">
                    <template #filter="props">
                        <slot name="filter" v-bind="props" />
                    </template>
                    <template #option="props">
                        <slot name="option" v-bind="props" />
                    </template>
                </primevue-listbox>
            </slot>
            <div class="error" v-if="field.error">
                <span class="message">{{ field.error }}</span>
            </div>
        </div>
        <div :class="field.after" v-if="field.after" />
    </form-field>
</template>

<script setup>
import { computed, onMounted, reactive, useTemplateRef } from 'vue';
import FormField from './renderless/FormField.vue';
import PrimevueListbox from 'primevue/listbox';

const input = useTemplateRef('input');
const options = reactive([]);

const props = defineProps({
    autofocus: {
        type: Boolean,
        default: false,
    },
    disableHighlight: {
        type: Boolean,
        default: false,
    },
    checkmark: {
        type: Boolean,
        default: false,
    },
    field: {
        type: Object,
        required: true,
    },
    filter: {
        type: Boolean,
        default: false,
    },
    highlightOnSelect: {
        type: Boolean,
        default: true,
    },
    multiple: {
        type: Boolean,
        default: false,
    },
    optionLabel: {
        type: String,
        default: null,
    },
    optionValue: {
        type: String,
        default: null,
    },
    scroller: {
        type: Object,
        required: false,
    },
});

const disableHighlightOnSelect = computed(() => props.highlightOnSelect === false || props.disableHighlight === true
    || props.field.highlightOnSelect === false || props.field.disableHighlight === true);
const enableCheckmark = computed(() => props.checkmark === true || props.field.checkmark === true);
const enableFilter = computed(() => props.filter === true || props.field.filter === true);
const enableMultiple = computed(() => props.multiple === true || props.field.multiple === true);
const enableOptionLabel = computed(() => props.optionLabel || props.field.options?.label || 'name');
const enableOptionValue = computed(() => props.optionValue || props.field.options?.value || 'id');
const enableVirtualScrollerOptions = computed(() => props.scroller || props.field.scroller || null);

onMounted(() => {
    if (props.autofocus === true || props.field.autofocus === true) {
        input.value.$el.focus();
    }
    if (Array.isArray(props.field.options?.values)) {
        options.push(...props.field.options.values);
    }
});
</script>
