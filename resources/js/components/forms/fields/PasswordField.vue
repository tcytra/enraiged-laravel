<template>
    <form-field v-slot:default="field">
        <line-break :field="field" v-if="field.break" />
        <div :class="field.before" v-if="field.before"/>
        <div class="control field" v-show="!field.isHidden"
            :class="[$attrs.class, field.class, field.type]">
            <slot name="label" v-bind="field">
                <field-label :field="field" v-if="field.label" />
            </slot>
            <slot name="field" v-bind="field">
                <primevue-password class="input primevue password" ref="input" v-model="field.form[field.id]"
                    :class="[{
                        'has-error': field.error,
                        'is-creating': field.isCreating,
                        'is-updating': field.isUpdating,
                    }, field.width]"
                    :disabled="field.isDisabled"
                    :feedback="field.feedback"
                    :input-id="field.id"
                    :invalid="!!field.error"
                    :placeholder="field.placeholder"
                    :size="field.size"
                    :toggle-mask="field.umask"
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
import ErrorMessage from '../parts/ErrorMessage.vue';
import FieldLabel from '../parts/FieldLabel.vue';
import FormField from './renderless/FormField.vue';
import LineBreak from '../parts/LineBreak.vue';
import PrimevuePassword from 'primevue/password';
</script>
