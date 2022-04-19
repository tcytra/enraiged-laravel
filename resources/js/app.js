import { createApp, h } from 'vue';
import { InertiaProgress } from '@inertiajs/progress';
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
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(store)
            .use(PrimeVue, { inputStyle: 'filled', ripple: true })
            .use(ConfirmationService)
            .use(VueAxios, axios)
            .mount(el);
    },
});
