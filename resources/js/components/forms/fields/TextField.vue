<template>
    <vue-form-field :form="form" :id="id" v-slot:default="{ error, update }">
        <div class="control text" :class="$attrs.class">
            <label v-if="label" class="label" :for="id">
                {{ label }}
            </label>
            <div class="field text">
                <primevue-input focus class="p-inputtext" type="text" ref="field"
                    v-model="model"
                    :class="{ 'p-inputtext-lg': isLarge, 'p-inputtext-sm': isSmall, 'p-invalid': error }"
                    :id="id"
                    :placeholder="placeholder"
                    :type="text"
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
import PrimevueInput from 'primevue/inputtext';
import VueFormField from '@/components/forms/VueFormField';

export default {
    inheritAttrs: false,

    components: {
        PrimevueInput,
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
        placeholder: String,
    },
};
</script>
