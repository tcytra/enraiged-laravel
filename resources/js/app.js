import { createApp, h } from 'vue';
import { InertiaProgress } from '@inertiajs/progress';
import { createI18n } from 'vue-i18n/index';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { createPinia } from 'pinia';
import ConfirmationService from 'primevue/confirmationservice';
import PrimeVue from 'primevue/config';
import axios from 'axios';
import VueAxios from 'vue-axios';

InertiaProgress.init();

const store = createPinia();

createInertiaApp({
    resolve: name => import(`./pages/${name}`),
    title: title => title ? `${title} - enRAIGEd` : 'enRAIGEd',
    setup({ el, App, props, plugin }) {
        const i18n = createI18n({
            fallbackLocale: 'en',
            locale: props.initialPage.props.auth
                ? props.initialPage.props.auth.user.language
                : 'en',
            messages: props.initialPage.props.i18n || {},
            silentFallbackWarn: true,
            silentTranslationWarn: true,
        });
        const app = createApp({ render: () => h(App, props) });
        const root = app
            .use(i18n)
            .use(plugin)
            .use(store)
            .use(PrimeVue, { inputStyle: 'filled', ripple: true })
            .use(ConfirmationService)
            .use(VueAxios, axios)
            .mount(el);
        // Temporary Config Required
        // re: https://vuejs.org/guide/components/provide-inject.html#working-with-reactivity
        app.config.unwrapInjectedRef = true;
    },
});
