<template>
    <div class="flex align-items-center">
        <label for="enableDarkMode" class="cursor-pointer px-3">
            <i class="pi pi-sun" v-if="enableDarkMode === false"></i>
            <i class="pi pi-moon" v-if="enableDarkMode === true"></i>
        </label>
        <toggle-switch class="hidden" inputId="enableDarkMode" v-model="enableDarkMode" />
    </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import ToggleSwitch from 'primevue/toggleswitch';

const enableDarkMode = localStorage.hasOwnProperty('enraiged.enableDarkMode')
    ? ref(localStorage.getItem('enraiged.enableDarkMode') === 'true')
    : ref(false);

const toggleDarkMode = (toggle) => {
    localStorage.setItem('enraiged.enableDarkMode', toggle);
    document.documentElement.classList.toggle('toggle-dark-mode', toggle);
}

toggleDarkMode(enableDarkMode.value);

watch(enableDarkMode, (toggle) => {
    toggleDarkMode(toggle);
});
</script>
