<template>
    <nav class="nav">
        <branding-header :meta="meta" />
        <main-menu :menu="menu" @menu:navigate="get($event, (menu.open === true && meta.agent === 'mobile'))" />
        <div class="block flex-grow-1" @click="menu.toggle()"/>
    </nav>
</template>

<script setup>
import { router } from '@inertiajs/vue3';
import BrandingHeader from '@/components/ui/BrandingHeader.vue';
import MainMenu from '@/components/ui/MainMenu.vue';

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

const get = (item) => {
    router.get(item.route);
    // menu.toggle(false);
};
</script>
