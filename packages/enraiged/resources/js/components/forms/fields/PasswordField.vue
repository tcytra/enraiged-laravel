<template>
    <vue-form-field v-slot:default="{ disabled, error, label, placeholder, update }"
        :field="field"
        :form="form"
        :id="id">
        <div class="control password" :class="$attrs.class">
            <label v-if="label" class="label" :for="id">
                {{ label }}
            </label>
            <div class="field"
                :class="{ confirm }">
                <primevue-password focus ref="field"
                    v-model="model"
                    :class="{ 'p-inputtext-lg': isLarge, 'p-inputtext-sm': isSmall, 'p-invalid': error }"
                    :disabled="disabled"
                    :feedback="feedback"
                    :id="id"
                    :placeholder="placeholder"
                    :toggle-mask="toggleMask"
                    @update:modelValue="update"/>
            </div>
            <div class="error" v-if="error">
                {{ error }}
            </div>
        </div>
    </vue-form-field>
</template>

<script>
import { v4 as uuid } from 'uuid';
import PrimevuePassword from 'primevue/password';
import VueFormField from '@/components/forms/VueFormField';

export default {
    inheritAttrs: false,

    components: {
        PrimevuePassword,
        VueFormField,
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
        toggleMask: {
            type: Boolean,
            default: false,
        },
    },

    computed: {
        model() {
            return this.form ? this.form[this.id] : null;
        },
    },
};
</script>
