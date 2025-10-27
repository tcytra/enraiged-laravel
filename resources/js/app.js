import '../css/app.css';
import './bootstrap';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { i18nVue } from 'laravel-vue-i18n';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import ConfirmationService from 'primevue/confirmationservice';
import DefaultLayout from '@/layouts/DefaultLayout.vue';
import PrimeVue from 'primevue/config';
import PrimevueTooltip from 'primevue/tooltip';
import ToastService from 'primevue/toastservice';
import theme from './themes/default';

const appName = import.meta.env.VITE_APP_NAME || 'Enraiged Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: async (name) => {
        const page = await resolvePageComponent(
            `./pages/${name}.vue`,
            import.meta.glob('./pages/**/*.vue'),
        );
        page.default.layout = typeof page.default.layout !== 'undefined'
            ? page.default.layout
            : DefaultLayout;
        return page;
    },
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .directive('tooltip', PrimevueTooltip)
            .use(i18nVue, {
                fallbackLang: 'en',
                resolve: async lang => {
                    const langs = import.meta.glob('../../lang/*.json');
                    return await langs[`../../lang/${lang}.json`]();
                },
            })
            .use(plugin)
            .use(ConfirmationService)
            .use(ToastService)
            .use(PrimeVue, theme)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
