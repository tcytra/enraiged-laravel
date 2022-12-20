<template>
    <headless-form-field v-slot:default="{ dirty, disabled, error, label, placeholder, update }"
        v-bind="$props">
        <div :class="field.before" v-if="field.before"/>
        <div class="control field calendar" v-show="show"
            :class="[$attrs.class, field.class, labels]">
            <label v-if="label" class="label" :for="id">
                {{ label }}
            </label>
            <primevue-calendar
                v-model="form[id]"
                :class="{
                    'is-creating': dirty && creating,
                    'is-updating': dirty && updating,
                    'p-inputtext-lg': isLarge,
                    'p-inputtext-sm': isSmall,
                    'p-invalid': error,
                }"
                :date-format="field.format || 'yy-mm-dd'"
                :disabled="disabled"
                :id="id"
                :placeholder="placeholder"
                :touchUI="isMobile || isTablet"
                @update:modelValue="update"/>
            <div class="error p-error" v-if="error">
                <i class="pi pi-exclamation-circle" v-tooltip.top="error"></i>
                <span class="message">{{ error }}</span>
            </div>
        </div>
        <div :class="field.after" v-if="field.after"/>
    </headless-form-field>
</template>

<script>
import { v4 as uuid } from 'uuid';
import HeadlessFormField from '@/components/forms/headless/FormField.vue';
import PrimevueCalendar from 'primevue/calendar';
import PrimevueTooltip from 'primevue/tooltip';

export default {
    inheritAttrs: false,

    components: {
        HeadlessFormField,
        PrimevueCalendar,
    },

    directives: {
        tooltip: PrimevueTooltip,
    },

    inject: ['isMobile', 'isTablet'],

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
