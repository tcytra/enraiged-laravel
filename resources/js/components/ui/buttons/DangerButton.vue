<template>
    <primevue-button severity="danger" :size="size" :type="type">
        <slot />
    </primevue-button>
</template>

<script setup>
import PrimevueButton from 'primevue/button';

defineProps({
    size: {
        type: String,
        default: 'normal',
    },
    type: {
        type: String,
        default: 'button',
    },
});
</script>
