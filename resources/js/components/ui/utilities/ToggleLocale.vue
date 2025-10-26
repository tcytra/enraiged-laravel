<template>
    <div>
        <select-button id="toggleLocale" :options="locales" size="small" v-model="enableLocale">
            <template #option="props">
                {{ props.option.toUpperCase() }}
            </template>
        </select-button>
    </div>
</template>

<script setup>
import { en } from "primelocale/js/en.js";
import { es } from "primelocale/js/es.js";
import { fr } from "primelocale/js/fr.js";
import { inject, ref, watch } from 'vue';
import { useLocales } from '@/handlers/locales';
import { usePrimeVue } from "primevue/config";
import SelectButton from 'primevue/selectbutton';

const { ai18n } = useLocales();
const { meta } = inject('app');
const locales = Object.keys(meta.value.locales);
const primelocales = { en, es, fr };
const primevue = usePrimeVue();

const enableLocale = localStorage.hasOwnProperty('enraiged.enableLocale')
    ? ref(localStorage.getItem('enraiged.enableLocale'))
    : ref('en');

const toggleLocale = (locale) => {
    localStorage.setItem('enraiged.enableLocale', locale);
    primevue.config.locale = primelocales[locale];
    ai18n(locale);
}

toggleLocale(enableLocale.value);

watch(enableLocale, (locale) => {
    toggleLocale(locale);
});
</script>
