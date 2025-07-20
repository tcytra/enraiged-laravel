<template>
    <primevue-card class="mx-auto max-w-7xl space-y-6">
        <template #content>
            <slot name="content" />
        </template>
    </primevue-card>
</template>

<script setup>
import PrimevueCard from 'primevue/card';
</script>
