<template>  
    <vue-form-field v-slot:default="{ disabled, error, label, placeholder, update }"
        :field="field"
        :form="form"
        :id="id">
        <div class="control text" :class="$attrs.class">
            <label v-if="label" class="label" :for="id">
                {{ label }}
            </label>
            <div class="field dropdown">
                <primevue-dropdown optionLabel="name" optionValue="id"
                    v-model="model"
                    :class="{ 'p-inputtext-lg': isLarge, 'p-inputtext-sm': isSmall, 'p-invalid': error }"
                    :disabled="disabled"
                    :id="id"
                    :options="field.options.values"
                    :placeholder="placeholder"
                    :show-clear="showClear"
                    @update:modelValue="update"/>
            </div>
            <div class="error" v-if="error">
                {{ error }}
            </div>
        </div>
    </vue-form-field>
</template>

<script>
import PrimevueDropdown from 'primevue/dropdown';
import VueFormField from '@/components/forms/VueFormField';

export default {
    inheritAttrs: false,

    components: {
        PrimevueDropdown,
        VueFormField,
    },

    props: {
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
        showClear: {
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
