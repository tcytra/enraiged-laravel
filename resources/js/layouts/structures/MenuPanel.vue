<template>
    <nav class="nav">
        <branding-header
            :meta="meta" />
        <main-menu
            :menu="menu"
            :mobile="meta.agent === 'mobile'" />
        <div class="block flex-grow-1" @click="menu.toggle()"/>
    </nav>
</template>

<script setup>
import BrandingHeader from '@/components/ui/BrandingHeader.vue';
import MainMenu from '@/layouts/menus/MainMenu.vue';

defineProps({
    menu: {
        type: Object,
        required: true,
    },
    meta: {
        type: Object,
        required: true,
    },
});
</script>
