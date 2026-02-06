<template>
    <form-field :field="field" v-slot:default="field">
        <line-break :field="field" v-if="field.break" />
        <div :class="field.before" v-if="field.before" />
        <div class="control field" v-show="!field.isHidden"
            :class="[$attrs.class, field.class, field.type]">
            <slot name="label" v-bind="field">
                <field-label :field="field" v-if="field.label" />
            </slot>
            <slot name="field" v-bind="field">
                <primevue-inputotp class="input primevue security" ref="input" v-model="field.form[field.id]"
                    :class="[{
                        'input-error': field.error,
                        'input-creating': field.isCreating,
                        'input-updating': field.isUpdating,
                    }, field.width]"
                    :disabled="field.isDisabled"
                    :input-id="field.id"
                    :invalid="!!field.error"
                    :length="enableFieldLength"
                    :mask="enableFieldMask"
                    :placeholder="field.placeholder"
                    :size="field.size"
                    @update:modelValue="field.update($event)" />
            </slot>
            <slot name="error" v-bind="field">
                <error-message :field="field" v-if="field.error" />
            </slot>
        </div>
        <div :class="field.after" v-if="field.after" />
    </form-field>
</template>

<script setup>
import { computed, onMounted, useTemplateRef } from 'vue';
import ErrorMessage from '../parts/ErrorMessage.vue';
import FieldLabel from '../parts/FieldLabel.vue';
import FormField from './renderless/FormField.vue';
import LineBreak from '../parts/LineBreak.vue';
import PrimevueInputotp from 'primevue/inputotp';

const input = useTemplateRef('input');

const props = defineProps({
    autofocus: {
        type: Boolean,
        default: false,
    },
    field: {
        type: Object,
        required: true,
    },
    length: {
        type: Number,
        default: null,
    },
    mask: {
        type: Boolean,
        default: false,
    },
});

const fieldLength = () => {
    const length = props.length || props.field.length;
    return !isNaN(length) && length >= 1
        ? length
        : null;
};

const enableFieldLength = computed(() => fieldLength());
const enableFieldMask = computed(() => props.mask === true || props.field.mask === true);

onMounted(() => {
    if (props.autofocus === true || props.field.autofocus === true) {
        input.value.$el.focus();
    }
});
</script>
