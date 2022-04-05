<template>
    <vue-form-field :form="form" :id="id" v-slot:default="{ error, update }">
        <div class="control text" :class="$attrs.class">
            <label v-if="label" class="label" :for="id">
                {{ label }}
            </label>
            <div class="field dropdown">
                <primevue-dropdown optionLabel="name" optionValue="code"
                    v-model="model"
                    :class="{ 'p-inputtext-lg': isLarge, 'p-inputtext-sm': isSmall, 'p-invalid': error }"
                    :id="id"
                    :options="options"
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
        focus: Boolean,
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
        label: String,
        model: String,
        options: {
            type: Array,
            required: true,
        },
        placeholder: String,
        showClear: Boolean,
    },
};
</script>
