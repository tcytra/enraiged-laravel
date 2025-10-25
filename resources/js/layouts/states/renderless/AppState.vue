<script>
import { computed, nextTick } from 'vue';
import { router } from '@inertiajs/vue3';
import { trans, getActiveLanguage, loadLanguageAsync } from 'laravel-vue-i18n';

export default {
    data: () => ({
        auth: false,
        menu: null,
        meta: null,
        ready: false,
        theme: null,
        toast: null,
        toggled: {
            auth: false,
            menu: false,
        },
    }),

    created() {
        this.fetchState();
    },

    methods: {
        async fetchState() {
            await axios.get(route('app.state'))
                .then((response) => {
                    const { data } = response;
                    this.auth = data.auth;
                    this.menu = data.menu;
                    this.meta = data.meta;
                    this.theme = data.theme;
                    this.toast = data.toast;
                    this.toggled.menu = data.meta.agent !== 'mobile';
                    nextTick(() => {
                        this.ready = true;
                    });
                });
        },
        logout() {
            router.post(route('logout'));
        },
        setTheme(theme) {
            if (typeof theme !== 'undefined') {
                if (Object.keys(this.theme).join('') !== Object.keys(theme).join('')) {
                    this.theme = {...this.theme, ...theme};
                    axios.patch(route('users.update', {user: this.auth.id}) + '/theme', { theme: this.theme })
                        .then((response) => {
                            const { data, status } = response;
                            if (data.success) {
                                // todo: toastr success
                            }
                        });
                }
            }
        },
        toggleAuth(value) {
            this.toggled.auth = typeof value !== 'undefined'
                ? value
                : !this.toggled.auth;
        },
        toggleMenu(value) {
            if (this.toggled.auth) {
                this.toggled.auth = false;
                this.toggled.menu = true;
            } else {
                this.toggled.menu = typeof value !== 'undefined'
                    ? value
                    : !this.toggled.menu;
            }
        },
    },

    provide() {
        return {
            app: {
                auth: computed(() => this.auth),
                meta: computed(() => this.meta),
                handle: {
                    action: this.handleAction,
                    error: this.handleError,
                },
                state: this.fetchState,
            },
            intl: {
                ai18n: loadLanguageAsync,
                i18n: trans,
                lang: getActiveLanguage,
            },
            logout: this.logout,
        };
    },

    render() {
        return this.$slots.default({
            auth: {
                logout: this.logout,
                open: this.toggled.auth === true,
                toggle: this.toggleAuth,
                user: this.auth,
            },
            menu: {
                ...this.menu,
                open: this.toggled.menu === true,
                toggle: this.toggleMenu,
            },
            meta: this.meta,
            ready: this.ready,
            toast: this.toast,
            theme: {
                config: this.theme,
                set: this.setTheme,
            },
        });
    },

    watch: {
        '$page.props.status': {
            handler() {
                const status = this.$page.props.status;
                switch (status) {
                    case 205:
                        this.fetchState();
                        break;
                }
            },
            deep: true,
        },
    },
};
</script>
