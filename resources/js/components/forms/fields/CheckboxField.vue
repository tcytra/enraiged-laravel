<template>
    <form-field :field="field" v-slot:default="field">
        <line-break :field="field" v-if="field.break" />
        <div :class="field.before" v-if="field.before" />
        <div class="control field" ref="control" v-show="!field.isHidden"
            :class="[$attrs.class, field.class, field.type]">
            <slot name="label" v-bind="field">
                <field-label :field="field" v-if="field.label" />
            </slot>
            <slot name="field" v-bind="field">
                <primevue-checkbox class="checkbox input primevue" ref="input" v-model="field.form[field.id]" binary
                    :class="{
                        'has-error': field.error,
                        'is-creating': field.isCreating,
                        'is-updating': field.isUpdating,
                    }"
                    :disabled="field.isDisabled"
                    :input-id="field.id"
                    :invalid="!!field.error"
                    :size="field.size"
                    @update:modelValue="field.update($event); $emit('update:modelValue', $event)" />
            </slot>
            <slot name="placeholder" v-bind="field">
                <div class="placeholder p-placeholder" v-if="field.placeholder && !field.error">
                    {{ field.placeholder }}
                </div>
            </slot>
            <slot name="error" v-bind="field">
                <error-message :class="{'mx-2': !checkboxFirst}" :field="field" v-if="field.error" />
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
import PrimevueCheckbox from 'primevue/checkbox';

const control = useTemplateRef('control');
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
});

const checkboxFirst = computed(() => input.value.$el.parentElement.className.match('checkbox-first').length);

onMounted(() => {
    if (props.autofocus === true || props.field.autofocus === true) {
        input.value.$el.focus();
    }
});
</script>
