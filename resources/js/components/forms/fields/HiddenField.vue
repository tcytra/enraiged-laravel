<template>
    <headless-form-field v-slot:default="{ error, isDirty, isDisabled, isHidden, label, placeholder, update }"
        v-bind="$props">
        <input type="hidden" ref="field"
            v-model="form[id]"
            :id="id"/>
    </headless-form-field>
</template>

<script>
import HeadlessFormField from '@/components/forms/headless/FormField.vue';

export default {
    inheritAttrs: false,

    components: {
        HeadlessFormField,
    },

    props: {
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
    },
};
</script>
