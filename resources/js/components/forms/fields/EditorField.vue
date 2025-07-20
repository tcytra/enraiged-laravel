<template>
    <form-field :field="field" ref="field" v-slot:default="field">
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
                <primevue-editor class="input primevue" ref="input" v-model="field.form[field.id]"
                    :class="[{
                        'input-success': field.isCreating,
                        'input-warning': field.isUpdating,
                        'input-error': field.error,
                    }, field.width]"
                    :editor-style="enableEditorStyle"
                    :input-id="field.id"
                    :placeholder="field.placeholder"
                    :readonly="enableReadonly"
                    @update:modelValue="field.update($event)">
                    <template v-slot:toolbar>
                        <slot name="toolbar" />
                    </template>
                </primevue-editor>
            </slot>
            <div class="error" v-if="field.error">
                <span class="message">{{ field.error }}</span>
            </div>
        </div>
        <div :class="field.after" v-if="field.after" />
    </form-field>
</template>

<script setup>
import { computed } from 'vue';
import FormField from './renderless/FormField.vue';
import PrimevueEditor from 'primevue/editor';

const props = defineProps({
    field: {
        type: Object,
        required: true,
    },
    height: {
        type: String,
        default: null,
    },
    readonly: {
        type: Boolean,
        default: false,
    },
});

const editorStyle = () => {
    const height = props.height || props.field.height;
    return typeof height !== 'undefined' && height.match(/^\d+(px|rem)$/)
        ? `height: ${height}`
        : null;
};

const enableReadonly = computed(() => props.readonly === true || props.field.readonly === true);
const enableEditorStyle = computed(() => editorStyle());
</script>
