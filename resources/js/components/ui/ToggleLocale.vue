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
import { inject, ref, watch } from 'vue';
import { loadLanguageAsync as ai18n, getActiveLanguage as lang } from 'laravel-vue-i18n';
import SelectButton from 'primevue/selectbutton';

const meta = inject('meta').value;

const locales = Object.keys(meta.locales);

const enableLocale = localStorage.hasOwnProperty('enraiged.enableLocale')
    ? ref(localStorage.getItem('enraiged.enableLocale'))
    : ref('en');

const toggleLocale = (locale) => {
    localStorage.setItem('enraiged.enableLocale', locale);
    ai18n(locale);
}

toggleLocale(enableLocale.value);

watch(enableLocale, (locale) => {
    toggleLocale(locale);
});
</script>
