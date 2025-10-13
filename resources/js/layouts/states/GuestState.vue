<template>
    <div class="guest layout">
        <header class="header">
            <div class="locale action">
                <toggle-locale class="toggle" />
            </div>
            <div class="theme group flex">
                <toggle-dark-mode class="mx-1 icon toggle" />
                <toggle-palette class="mx-1 icon toggle" />
            </div>
        </header>
        <main class="content flex items-center justify-center main">
            <slot />
        </main>
    </div>
</template>

<script setup>
import ToggleDarkMode from '@/components/ui/utilities/ToggleDarkMode.vue';
import ToggleLocale from '@/components/ui/utilities/ToggleLocale.vue';
import TogglePalette from '@/components/ui/utilities/TogglePalette.vue';
</script>
