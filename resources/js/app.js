import '../css/app.css';
import { createSSRApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { i18nVue } from "laravel-vue-i18n";
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import ConfirmationService from 'primevue/confirmationservice';
import PrimeVue from 'primevue/config';
import axios from 'axios';
import VueAxios from 'vue-axios';

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./pages/**/*.vue', { eager: true });
        return pages[`./pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        createSSRApp({ render: () => h(App, props) })
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
            .use(VueAxios, axios)
            .mount(el);
    },
});
