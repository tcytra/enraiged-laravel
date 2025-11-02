<template>
    <div class="">
        <label for="toggleDarkMode" class="cursor-pointer item label">
            <i class="pi pi-sun" v-if="enableDarkMode === false"></i>
            <i class="pi pi-moon" v-if="enableDarkMode === true"></i>
        </label>
        <toggle-switch class="hidden" inputId="toggleDarkMode" v-model="enableDarkMode" />
    </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import { palette } from '@/themes/palette';
import ToggleSwitch from 'primevue/toggleswitch';

const { theme } = defineProps({
    theme: {
        type: Object,
        default: null,
    },
});

const { enableDarkMode, toggleDarkMode } = palette();

const enabled = theme
    ? (theme.config.mode === 'dark')
    : enableDarkMode.value;

toggleDarkMode(enabled);

watch(enableDarkMode, (value) => {
    //if (theme && theme.config.mode !== value ? 'dark' : 'light') {
    if (theme) {
        //console.log('set theme from toggle dark mode');
        theme.set({ mode: value ? 'dark' : 'light' });
    }
    toggleDarkMode(value);
});
</script>
