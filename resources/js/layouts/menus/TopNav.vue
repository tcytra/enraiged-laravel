<template>
    <nav class="nav top">
        <div class="inline action"
            @click="$emit('menu:toggle')">
            <i class="pi pi-bars"></i>
        </div>
        <div class="block" />
        <div class="inline action"
            @click="$emit('auth:toggle')">
            <i class="pi pi-user"></i>
        </div>
    </nav>
</template>

<script>
export default {
    emits: ['auth:toggle', 'menu:toggle'],
};
</script>
