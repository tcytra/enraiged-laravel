<template>
    <header class="branding header">
        <span class="menu-closed text">{{ meta.initials }}</span>
        <span class="menu-open text">{{ meta.name }}</span>
    </header>
</template>

<script setup>
defineProps({
    meta: {
        type: Object,
        required: true,
    },
});
</script>
