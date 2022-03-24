<template>
    <div :class="$attrs.class">
        <label v-if="label" class="form-label" :for="id">
            {{ label }}
        </label>
        <Password ref="field"
            v-model="model"
            :class="{ 'p-inputtext-lg': isLarge, 'p-inputtext-sm': isSmall, 'p-invalid': errors[id] }"
            :feedback="feedback"
            :id="id"
            :placeholder="placeholder"
            :toggle-mask="toggleMask"
            @update:modelValue="update"/>
        <div class="form-error" v-if="errors[id]">
            {{ errors[id] }}
        </div>
    </div>
</template>

<script>
import { v4 as uuid } from 'uuid';
import Password from 'primevue/password';

export default {
    inheritAttrs: false,

    components: {
        Password,
    },

    props: {
        errors: {
            type: Object,
            default: {},
        },
        feedback: Boolean,
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

    emits: ['update:value'],

    methods: {
        update(value) {
            this.$emit('update:value', { id: this.id, value });
        },
    },
};
</script>
