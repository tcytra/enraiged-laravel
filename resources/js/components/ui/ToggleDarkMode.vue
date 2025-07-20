<template>
    <div class="flex align-items-center">
        <label for="toggleDarkMode" class="cursor-pointer mr-3">
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

const { enableDarkMode, toggleDarkMode } = palette();

toggleDarkMode(enableDarkMode.value);

watch(enableDarkMode, (toggle) => {
    toggleDarkMode(toggle);
});
</script>
