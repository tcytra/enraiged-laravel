<template>
    <form-field :field="field" v-slot:default="field">
        <div class="col-12 line-break" v-if="field.break">
            <hr :class="field.break" v-if="typeof field.break === 'string'">
            <hr v-else>
        </div>
        <div :class="field.before" v-if="field.before" />
        <div class="control field" ref="control" v-show="!field.isHidden"
            :class="[$attrs.class, field.class, field.type]">
            <slot name="label" v-bind="field">
                <label class="label" ref="label" :for="field.id" v-if="field.label">
                    {{ field.label }}
                </label>
            </slot>
            <slot name="field" v-bind="field">
                <primevue-checkbox class="input primevue" ref="input" v-model="field.form[field.id]" binary
                    :class="{
                        'input-success': field.isCreating,
                        'input-warning': field.isUpdating,
                        'input-error': field.error,
                    }"
                    :disabled="field.isDisabled"
                    :input-id="field.id"
                    :invalid="!!field.error"
                    :size="field.size"
                    @update:modelValue="field.update($event); $emit('update:modelValue', $event)" />
            </slot>
            <div class="placeholder p-placeholder" v-if="field.placeholder && !field.error">
                {{ i18n(field.placeholder) }}
            </div>
            <div class="error" v-if="field.error"
                :class="{'mx-2': !checkboxFirst}">
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
