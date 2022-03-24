<template>
    <div :class="$attrs.class">
        <label v-if="label" class="form-label" :for="id">
            {{ label }}
        </label>
        <InputText class="p-inputtext" type="text" ref="field"
            v-model="model"
            :class="{ 'p-inputtext-lg': isLarge, 'p-inputtext-sm': isSmall, 'p-invalid': errors[id] }"
            :id="id"
            :placeholder="placeholder"
            :type="type"
            @update:modelValue="update"/>
        <div class="form-error" v-if="errors[id]">
            {{ errors[id] }}
        </div>
    </div>
</template>

<script>
import { v4 as uuid } from 'uuid';
import InputText from 'primevue/inputtext';

export default {
    inheritAttrs: false,

    components: {
        InputText,
    },

    props: {
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
        errors: {
            type: Object,
            default: {},
        },
        label: String,
        model: String,
        placeholder: String,
        type: {
            type: String,
            default: 'text',
        },
    },

    emits: ['update:value'],

    methods: {
        update(value) {
            this.$emit('update:value', { id: this.id, value });
        },
    },
};
</script>
