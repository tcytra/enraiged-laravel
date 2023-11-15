import '../css/app.css';
import { createSSRApp, h } from 'vue';
import { createI18n } from 'vue-i18n';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import ConfirmationService from 'primevue/confirmationservice';
import PrimeVue from 'primevue/config';
import axios from 'axios';
import VueAxios from 'vue-axios';

createInertiaApp({
    // resolve: (name) => resolvePageComponent(`./pages/${name}.vue`, import.meta.glob('./pages/**/*.vue')),
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
        createSSRApp({ render: () => h(App, props) })
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
        //  Update (2023-09-16): This doesn't appear to be necessary any more
        //app.config.unwrapInjectedRef = true;
    },
});
