<template>
    <vue-form-field :form="form" :id="id" v-slot:default="{ error, update }">
        <div class="control password" :class="$attrs.class">
            <label v-if="label" class="label" :for="id">
                {{ label }}
            </label>
            <div class="field"
                :class="{ confirm }">
                <primevue-password focus ref="field"
                    v-model="model"
                    :class="{ 'p-inputtext-lg': isLarge, 'p-inputtext-sm': isSmall, 'p-invalid': error }"
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
        confirm: Boolean,
        feedback: Boolean,
        focus: Boolean,
        form: {
            type: Object,
            required: true,
        },
        id: {
            type: String,
            required: true,
        },
        isLarge: Boolean,
        isSmall: Boolean,
        label: String,
        model: String,
        placeholder: String,
        toggleMask: Boolean,
    },
};
</script>
