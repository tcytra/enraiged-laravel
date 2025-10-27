<template>
    <form-field :field="field" :form="form" ref="field" v-slot:default="field">
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
                <primevue-textarea class="textarea input primevue" ref="input" v-model="field.form[field.id]"
                    :auto-resize="enableAutoResize"
                    :class="[{
                        'has-error': field.error,
                        'is-creating': field.isCreating,
                        'is-updating': field.isUpdating,
                    }, !enableTextareaCols ? field.width : '']"
                    :cols="enableTextareaCols"
                    :input-id="field.id"
                    :invalid="!!field.error"
                    :placeholder="field.placeholder"
                    :rows="enableTextareaRows"
                    :size="field.size"
                    @update:modelValue="update($event); $emit('update:modelValue', $event)" />
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
import FormField from './renderless/FormField.vue';
import PrimevueTextarea from 'primevue/textarea';

const input = useTemplateRef('input');

const props = defineProps({
    autofocus: {
        type: Boolean,
        default: false,
    },
    autoresize: {
        type: Boolean,
        default: false,
    },
    chars: {
        type: Number,
        required: false,
    },
    field: {
        type: Object,
        required: true,
    },
    form: {
        type: Object,
        required: true,
    },
    rows: {
        type: Number,
        required: false,
    },
});

// const enableAllowedChars = computed(() => props.chars || props.field.chars || null);
const enableAutoResize = computed(() => props.autoresize === true || props.field.autoresize === true);
const enableTextareaCols = computed(() => props.cols || props.field.cols || null);
const enableTextareaRows = computed(() => props.rows || props.field.rows || null);

onMounted(() => {
    if (props.autofocus === true || props.field.autofocus === true) {
        input.value.$el.focus();
    }
});
</script>
