import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { i18nVue } from "laravel-vue-i18n";
import ConfirmationService from 'primevue/confirmationservice';
import PrimeVue from 'primevue/config';

const appName = import.meta.env.VITE_APP_NAME || 'Enraiged';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./pages/${name}.vue`, import.meta.glob('./pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(i18nVue, {
                fallbackLang: 'en',
                resolve: async lang => {
                    const langs = import.meta.glob('../../lang/*.json');
                    return await langs[`../../lang/${lang}.json`]();
                },
            })
            .use(plugin)
            .use(PrimeVue, { inputStyle: 'filled', ripple: true })
            .use(ConfirmationService)
            .mount(el);
    },
});
