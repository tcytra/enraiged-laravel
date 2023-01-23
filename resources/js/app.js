import '../css/app.css';
import { createApp, h } from 'vue';
import { createI18n } from 'vue-i18n';
import { createInertiaApp } from '@inertiajs/vue3';
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
        const i18n = createI18n({
            fallbackLocale: 'en',
            locale: props.initialPage.props.language || 'en',
            messages: props.initialPage.props.i18n || {},
            silentFallbackWarn: true,
            silentTranslationWarn: true,
        });
        const app = createApp({ render: () => h(App, props) });
        const root = app
            .use(i18n)
            .use(plugin)
            .use(PrimeVue, { inputStyle: 'filled', ripple: true })
            .use(ConfirmationService)
            .use(VueAxios, axios)
            .mount(el);
        //  This is temporarily required in order to provide computed data for injection
        //  see: Temporary Config Required
        //  at: https://vuejs.org/guide/components/provide-inject.html#working-with-reactivity
        //  The current stable version of Vue (at this time) is v3.2.45
        app.config.unwrapInjectedRef = true;
    },
});
