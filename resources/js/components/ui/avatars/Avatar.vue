<template>
    <img v-if="avatar">
    <i class="pi pi-user" v-else></i>
</template>

<script setup>
defineProps({
    avatar: {
        type: Object,
        default: null,
    },
});    
</script>
