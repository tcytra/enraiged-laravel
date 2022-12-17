<template>
    <vue-form-field v-slot:default="{ disabled, error, label, placeholder, update }"
        v-bind="{...$props, ...$attrs}">
        <div class="control field text" :class="[$attrs.class, field.class, { confirm }, labels]">
            <label v-if="label" class="label" :for="id">
                {{ label }}
            </label>
            <primevue-password class="w-full" ref="field" focus
                v-model="form[id]"
                :class="{
                    'p-inputtext-lg': isLarge,
                    'p-inputtext-sm': isSmall,
                    'p-invalid': error,
                }"
                :disabled="disabled"
                :feedback="feedback"
                :id="id"
                :placeholder="placeholder"
                :toggle-mask="toggleMask"
                @update:modelValue="update"/>
            <div class="error p-error" v-if="error">
                <i class="pi pi-exclamation-circle" v-tooltip.top="error"></i>
                <span class="message">{{ error }}</span>
            </div>
        </div>
    </vue-form-field>
</template>

<script>
import { v4 as uuid } from 'uuid';
import PrimevuePassword from 'primevue/password';
import PrimevueTooltip from 'primevue/tooltip';
import VueFormField from '@/components/forms/VueFormField';

export default {
    inheritAttrs: false,

    components: {
        PrimevuePassword,
        VueFormField,
    },

    directives: {
        tooltip: PrimevueTooltip,
    },

    props: {
        field: {
            type: Object,
            required: true,
        },
        confirm: {
            type: Boolean,
            default: false,
        },
        feedback: {
            type: Boolean,
            default: false,
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
        labels: {
            type: String,
            default: null,
        },
        toggleMask: {
            type: Boolean,
            default: false,
        },
    },
};
</script>
