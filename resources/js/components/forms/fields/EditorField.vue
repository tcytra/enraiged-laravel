<template>
    <form-field :field="field" ref="field" v-slot:default="field">
        <line-break :field="field" v-if="field.break" />
        <div :class="field.before" v-if="field.before" />
        <div class="control field" v-show="!field.isHidden"
            :class="[$attrs.class, field.class, field.type]">
            <slot name="label" v-bind="field">
                <field-label :field="field" v-if="field.label" />
            </slot>
            <slot name="field" v-bind="field">
                <primevue-editor class="editor input primevue" ref="input" v-model="field.form[field.id]"
                    :class="[{
                        'has-error': field.error,
                        'is-creating': field.isCreating,
                        'is-updating': field.isUpdating,
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
            <slot name="error" v-bind="field">
                <error-message :field="field" v-if="field.error" />
            </slot>
        </div>
        <div :class="field.after" v-if="field.after" />
    </form-field>
</template>

<script setup>
import { computed } from 'vue';
import ErrorMessage from '../parts/ErrorMessage.vue';
import FieldLabel from '../parts/FieldLabel.vue';
import FormField from './renderless/FormField.vue';
import LineBreak from '../parts/LineBreak.vue';
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
