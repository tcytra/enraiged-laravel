<template>
    <div id="layout" class="guest layout">
        <header class="flex items-center justify-between">
            <div class="mx-5">
                <toggle-locale class="" />
            </div>
            <div class="flex mx-5">
                <toggle-dark-mode class="mx-1" />
                <toggle-palette class="mx-1" />
            </div>
        </header>
        <main class="flex items-center justify-center">
            <slot />
        </main>
    </div>
</template>

<script setup>
import ToggleDarkMode from '@/components/ui/ToggleDarkMode.vue';
import ToggleLocale from '@/components/ui/ToggleLocale.vue';
import TogglePalette from '@/components/ui/TogglePalette.vue';
</script>
