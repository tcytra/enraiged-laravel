<template>
    <vue-form-field v-slot:default="{ dirty, disabled, error, label, placeholder, update }"
        v-bind="{...$props, ...$attrs}">
        <div class="control field text" v-show="show"
            :class="[$attrs.class, field.class, labels]">
            <label v-if="label" class="label" :for="id">
                {{ label }}
            </label>
            <primevue-input-text class="w-full" type="text" ref="field" focus
                v-model="form[id]"
                :class="{
                    'is-creating': dirty && creating,
                    'is-updating': dirty && updating,
                    'p-inputtext-lg': isLarge,
                    'p-inputtext-sm': isSmall,
                    'p-invalid': error,
                }"
                :disabled="disabled"
                :id="id"
                :placeholder="placeholder"
                :type="text"
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
import PrimevueInputText from 'primevue/inputtext';
import PrimevueTooltip from 'primevue/tooltip';
import VueFormField from '@/components/forms/VueFormField';

export default {
    inheritAttrs: false,

    components: {
        PrimevueInputText,
        VueFormField,
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
        labels: {
            type: String,
            default: null,
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
