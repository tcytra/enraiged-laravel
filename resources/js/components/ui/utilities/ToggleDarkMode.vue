<template>
    <div class="">
        <label for="toggleDarkMode" class="cursor-pointer item label">
            <i class="pi pi-sun" v-if="darkModeEnabled === false"></i>
            <i class="pi pi-moon" v-if="darkModeEnabled === true"></i>
        </label>
        <toggle-switch class="hidden" inputId="toggleDarkMode" v-model="darkmode" />
    </div>
</template>

<script setup>
import { inject, ref, watch } from 'vue';
import { palette } from '@/themes/palette';
import ToggleSwitch from 'primevue/toggleswitch';

const { theme } = inject('app');

const { darkModeEnabled, toggleDarkMode } = palette();

const darkmode = ref(darkModeEnabled.value);

watch(darkmode, (value) => {
    theme({ darkmode: value });
    toggleDarkMode(value);
});
</script>
