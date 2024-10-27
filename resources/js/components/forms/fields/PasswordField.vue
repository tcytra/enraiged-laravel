<template>
    <headless-form-field v-slot:default="{ error, isDisabled, isHidden, label, placeholder, update }"
        v-bind="$props">
        <div class="col-12 line-break" v-if="field.break">
            <hr :class="field.break" v-if="typeof field.break === 'string'">
            <hr v-else>
        </div>
        <div :class="field.before" v-if="field.before"/>
        <div class="control field text" :class="[$attrs.class, field.class, { confirm }]">
            <label v-if="label" class="label" :for="id">
                {{ label }}
            </label>
            <primevue-password class="w-full" ref="field" v-show="show && !isHidden" focus
                v-model="form[id]"
                :class="{
                    'p-inputtext-lg': isLarge,
                    'p-inputtext-sm': isSmall,
                    'p-invalid': invalid || error,
                }"
                :disabled="isDisabled"
                :feedback="enableFeedback"
                :id="id"
                :placeholder="placeholder || field.placeholder"
                :toggle-mask="enableUnmask"
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
import PrimevuePassword from 'primevue/password';
import PrimevueTooltip from 'primevue/tooltip';

export default {
    inheritAttrs: false,

    components: {
        HeadlessFormField,
        PrimevuePassword,
    },

    directives: {
        tooltip: PrimevueTooltip,
    },

    props: {
        confirm: {
            type: Boolean,
            default: false,
        },
        disabled: {
            type: Boolean,
            default: false,
        },
        feedback: {
            type: Boolean,
            required: false,
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
        invalid: {
            type: Boolean,
            default: false,
        },
        show: {
            type: Boolean,
            default: true,
        },
        unmask: {
            type: Boolean,
            required: false,
        },
    },

    computed: {
        enableFeedback() {
            return this.feedback === true
                || this.field.feedback === true;
        },
        enableUnmask() {
            return this.unmask === true
                || this.field.unmask === true
                || this.field.toggleMask === true;
        },
    },
};
</script>
