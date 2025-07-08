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
                <primevue-inputotp class="input primevue" ref="input" v-model="field.form[field.id]"
                    :class="[{
                        'input-success': field.isCreating,
                        'input-warning': field.isUpdating,
                        'input-error': field.error,
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
            <div class="error" v-if="field.error">
                <span class="message">{{ field.error }}</span>
            </div>
        </div>
        <div :class="field.after" v-if="field.after" />
    </form-field>
</template>

<script setup>
import { computed, onMounted, useTemplateRef } from 'vue';
import { trans as i18n } from 'laravel-vue-i18n';
import FormField from './renderless/FormField.vue';
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
