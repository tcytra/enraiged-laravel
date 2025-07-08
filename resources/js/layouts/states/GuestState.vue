<template>
    <div id="layout" class="guest layout">
        <header class="flex items-center justify-between">
            <toggle-locale class="mx-5" />
            <toggle-dark-mode class="mx-5" />
        </header>
        <main class="flex items-center justify-center">
            <slot />
        </main>
    </div>
</template>

<script setup>
import ToggleDarkMode from '@/components/ui/ToggleDarkMode.vue';
import ToggleLocale from '@/components/ui/ToggleLocale.vue';
</script>
