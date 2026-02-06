<template>
    <div class="error" :class="class">
        <span class="message">{{ field.error }}</span>
    </div>
</template>

<script setup>
defineProps({
    class: {
        type: String,
        default: null,
    },
    field: {
        type: Object,
        required: true,
    },
});
</script>
