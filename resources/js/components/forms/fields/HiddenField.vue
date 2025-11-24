<template>
    <input :id="field.id" type="hidden" ref="input" v-model="form[field.id]" />
</template>

<script setup>
defineProps({
    field: {
        type: Object,
        required: true,
    },
    form: {
        type: Object,
        required: true,
    },
});
</script>
