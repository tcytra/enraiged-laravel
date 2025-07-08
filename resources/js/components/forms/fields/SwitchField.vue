<template>
    <form-field :field="field" v-slot:default="field">
        <div class="col-12 line-break" v-if="field.break">
            <hr :class="field.break" v-if="typeof field.break === 'string'">
            <hr v-else>
        </div>
        <div :class="field.before" v-if="field.before"/>
        <div class="control field " v-show="!field.isHidden"
            :class="[$attrs.class, field.class, field.type]">
            <slot name="label" v-bind="field">
                <label class="label" ref="label" :for="field.id" v-if="field.label">
                    {{ field.label }}
                </label>
            </slot>
            <slot name="field" v-bind="field">
                <primevue-switch class="input primevue" ref="input" v-model="field.form[field.id]"
                    :disabled="field.isDisabled"
                    :input-id="field.id"
                    :invalid="!!field.error"
                    :size="field.size"
                    @update:modelValue="field.update($event); $emit('update:modelValue', $event)">
                    <template #handle="props">
                        <slot name="handle" v-bind="props" />
                    </template>
                </primevue-switch>
            </slot>
            <div class="placeholder p-placeholder" v-if="field.placeholder && !field.error">
                {{ i18n(field.placeholder) }}
            </div>
            <div class="error" v-if="field.error"
                :class="{'mx-2': !checkboxFirst}">
                <span class="message">{{ field.error }}</span>
            </div>
        </div>
        <div :class="field.after" v-if="field.after"/>
    </form-field>
</template>

<script setup>
import { computed, onMounted, useTemplateRef } from 'vue';
import { trans as i18n } from 'laravel-vue-i18n';
import FormField from './renderless/FormField.vue';
import PrimevueSwitch from 'primevue/toggleswitch';

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
