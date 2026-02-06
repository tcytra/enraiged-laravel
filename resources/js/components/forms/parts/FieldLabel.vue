<template>
    <label class="label" ref="label" :for="field.id">
        {{ field.label }}
    </label>
</template>

<script setup>
defineProps({
    field: {
        type: Object,
        required: true,
    },
});
</script>
