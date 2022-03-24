<template>
    <div :class="$attrs.class">
        <label v-if="label" class="form-label" :for="id">
            {{ label }}
        </label>
        <InputSwitch  v-model="model" :id="id"
            @update:modelValue="update"/>
        <div class="form-error" v-if="errors[id]">
            {{ errors[id] }}
        </div>
    </div>
</template>

<script>
import { v4 as uuid } from 'uuid';
import InputSwitch from 'primevue/inputswitch';

export default {
    inheritAttrs: false,

    components: {
        InputSwitch,
    },

    props: {
        id: {
            type: String,
            required: true,
        },
        errors: {
            type: Object,
            default: {},
        },
        label: String,
        model: {
            type: Boolean,
            default: false,
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
