<template>
    <headless-form-field v-slot:default="{ error, isDirty, isDisabled, isHidden, label, placeholder, update }"
        v-bind="$props">
        <div class="col-12 line-break" v-if="field.break"><hr class=""></div>
        <div :class="field.before" v-if="field.before"/>
        <div class="control field text" v-show="show && !isHidden"
            :class="[$attrs.class, field.class]">
            <label v-if="label" class="label" :for="id">
                {{ label }}
            </label>
            <primevue-input-text class="w-full" type="text" ref="field" focus
                v-model="form[id]"
                :class="{
                    'is-creating': isDirty && creating,
                    'is-updating': isDirty && updating,
                    'p-inputtext-lg': isLarge,
                    'p-inputtext-sm': isSmall,
                    'p-invalid': error,
                }"
                :disabled="isDisabled"
                :id="id"
                :placeholder="placeholder"
                :type="text"
                @update:modelValue="update(); $emit('update:modelValue', $event)"/>
            <div class="error p-error" v-if="error">
                <i class="pi pi-exclamation-circle" v-tooltip.top="error"></i>
                <span class="message">{{ error }}</span>
            </div>
        </div>
        <div :class="field.after" v-if="field.after"/>
    </headless-form-field>
</template>

<script>
import HeadlessFormField from '@/components/forms/headless/FormField.vue';
import PrimevueInputText from 'primevue/inputtext/InputText.vue';
import PrimevueTooltip from 'primevue/tooltip/tooltip.esm.js';

export default {
    inheritAttrs: false,

    components: {
        HeadlessFormField,
        PrimevueInputText,
    },

    directives: {
        tooltip: PrimevueTooltip,
    },

    props: {
        creating: {
            type: Boolean,
            default: false,
        },
        field: {
            type: Object,
            required: true,
        },
        focus: {
            type: Boolean,
            default: false,
        },
        form: {
            type: Object,
            required: true,
        },
        id: {
            type: String,
            required: true,
        },
        isLarge: {
            type: Boolean,
            default: false,
        },
        isSmall: {
            type: Boolean,
            default: false,
        },
        show: {
            type: Boolean,
            default: true,
        },
        updating: {
            type: Boolean,
            default: false,
        },
    },
};
</script>
