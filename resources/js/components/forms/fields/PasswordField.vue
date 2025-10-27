<template>
    <form-field v-slot:default="field">
        <div class="col-12 line-break" v-if="field.break">
            <hr :class="field.break" v-if="typeof field.break === 'string'">
            <hr v-else>
        </div>
        <div :class="field.before" v-if="field.before"/>
        <div class="control field" v-show="!field.isHidden"
            :class="[$attrs.class, field.class, field.type]">
            <slot name="label" v-bind="field">
                <label class="label" ref="label" :for="field.id" v-if="field.label">
                    {{ field.label }}
                </label>
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
            <div class="error" v-if="field.error">
                <span class="message">{{ field.error }}</span>
            </div>
        </div>
        <div :class="field.after" v-if="field.after" />
    </form-field>
</template>

<script setup>
import FormField from './renderless/FormField.vue';
import PrimevuePassword from 'primevue/password';
</script>
