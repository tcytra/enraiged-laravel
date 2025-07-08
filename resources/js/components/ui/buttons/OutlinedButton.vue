<template>
    <primevue-button :size="size" outlined>
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
