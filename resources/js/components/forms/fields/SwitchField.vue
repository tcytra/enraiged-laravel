<template>
    <headless-form-field v-slot:default="{ error, isDirty, isDisabled, isHidden, label, update }"
        v-bind="$props">
        <div class="col-12 line-break" v-if="field.break"><hr class=""></div>
        <div :class="field.before" v-if="field.before"/>
        <div class="control field switch" v-show="show && !isHidden"
            :class="[
                $attrs.class,
                field.class,
                { 'switch-first': field.switchFirst || switchFirst },
            ]">
            <label v-if="label" class="label" :for="id">
                {{ label }}
            </label>
            <primevue-switch ref="field"
                v-model="form[id]"
                :class="{
                    'is-creating': isDirty && creating,
                    'is-updating': isDirty && updating,
                    'p-invalid': error,
                }"
                :disabled="isDisabled"
                :id="id"
                @change="$emit('change')"
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
import PrimevueSwitch from 'primevue/inputswitch/InputSwitch.vue';
import PrimevueTooltip from 'primevue/tooltip/tooltip.esm.js';

export default {
    inheritAttrs: false,

    components: {
        HeadlessFormField,
        PrimevueSwitch,
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
        form: {
            type: Object,
            required: true,
        },
        id: {
            type: String,
            required: true,
        },
        show: {
            type: Boolean,
            default: true,
        },
        switchFirst: {
            type: Boolean,
            default: false,
        },
        updating: {
            type: Boolean,
            default: false,
        },
    },
};
</script>
