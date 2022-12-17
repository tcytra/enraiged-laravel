<template>
    <vue-form-field v-slot:default="{ dirty, error, label, update }"
        v-bind="{...$props, ...$attrs}">
        <div class="control field switch" v-show="show"
            :class="[
                $attrs.class,
                field.class,
                labels,
                { 'switch-first': switchFirst },
            ]">
            <label v-if="label" class="label" :for="id">
                {{ label }}
            </label>
            <primevue-switch
                v-model="form[id]"
                :class="{
                    'is-creating': dirty && creating,
                    'is-updating': dirty && updating,
                    'p-invalid': error,
                }"
                :id="id"
                @change="$emit('change')"
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
import PrimevueSwitch from 'primevue/inputswitch';
import PrimevueTooltip from 'primevue/tooltip';
import VueFormField from '@/components/forms/VueFormField';

export default {
    inheritAttrs: false,

    components: {
        PrimevueSwitch,
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
        form: {
            type: Object,
            required: true,
        },
        id: {
            type: String,
            required: true,
        },
        labels: {
            type: String,
            default: null,
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
