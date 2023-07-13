<template>
    <headless-form-field v-slot:default="props" v-bind="$props">
        <div class="col-12 line-break" v-if="field.break"><hr class=""></div>
        <div :class="field.before" v-if="field.before"/>
        <div class="control field checkbox align-items-center" v-show="!props.isHidden"
            :class="[$attrs.class, field.class]">
            <label v-if="props.label" class="label" :for="id">
                {{ props.label }}
            </label>
            <primevue-checkbox :id="id" ref="field"
                v-model="props.form[id]"
                :binary="field.binary || binary"
                :disabled="props.isDisabled"
                @update:modelValue="props.update(); $emit('update:modelValue', $event)"/>
            <div class="error p-error" v-if="props.error">
                <i class="pi pi-exclamation-circle" v-tooltip.top="props.error"></i>
                <span class="message">{{ props.error }}</span>
            </div>
        </div>
        <div :class="field.after" v-if="field.after"/>
    </headless-form-field>
</template>

<script>
import HeadlessFormField from '@/components/forms/headless/FormField.vue';
import PrimevueCheckbox from 'primevue/checkbox/Checkbox.vue';
import PrimevueTooltip from 'primevue/tooltip/tooltip.esm.js';

export default {
    inheritAttrs: false,

    components: {
        HeadlessFormField,
        PrimevueCheckbox,
    },

    directives: {
        tooltip: PrimevueTooltip,
    },

    props: {
        binary: {
            type: Boolean,
            default: true,
        },
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
        updating: {
            type: Boolean,
            default: false,
        },
    },
};
</script>
