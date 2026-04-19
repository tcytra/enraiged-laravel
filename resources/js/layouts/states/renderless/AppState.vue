<script>
import { computed, inject, nextTick } from 'vue';
import { getActiveLanguage, loadLanguageAsync } from 'laravel-vue-i18n';
import { palette } from '@/themes/palette';
import { router } from '@inertiajs/vue3';

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

    inject: ['route'],

    setup() {
        const {
            currentPrimaryColor,
            currentSurfaceColor,
            darkModeEnabled,
            toggleDarkMode,
            updatePrimaryColor,
            updateSurfaceColor,
        } = palette();

        toggleDarkMode();

        return {
            currentPrimaryColor,
            currentSurfaceColor,
            darkModeEnabled,
            toggleDarkMode,
            updatePrimaryColor,
            updateSurfaceColor,
        };
    },

    mounted() {
        this.fetchState();
    },

    methods: {
        async fetchState() {
            await axios.get(this.route('app.state'))
                .then((response) => {
                    const { data } = response;
                    this.auth = data.auth;
                    this.menu = data.menu;
                    this.meta = data.meta;
                    this.toast = data.toast;
                    this.toggled.menu = data.meta.agent !== 'mobile';
                    this.setLocale();
                    if (data.auth && data.theme) {
                        this.toggleDarkMode(data.theme.darkmode);
                        this.updatePrimaryColor(data.theme.primary);
                        this.updateSurfaceColor(data.theme.surface);
                    }
                    nextTick(() => {
                        this.ready = true;
                    });
                });
        },
        logout() {
            router.post(
                this.route('logout'), {}, {
                    onFinish: () => {
                        this.fetchState();
                    }
                }
            );
        },
        setLocale() {
            const locale = getActiveLanguage();
            if (this.auth.locale !== locale) {
                loadLanguageAsync(this.auth.locale);
            }
        },
        setTheme(update) {
            if (this.auth) {
                const theme = {
                    darkmode: this.darkModeEnabled,
                    primary: this.currentPrimaryColor,
                    surface: this.currentSurfaceColor,
                    ...update,
                };
                axios.patch(this.route('users.update', {user: this.auth.id}) + '/theme', { theme })
                    .then((response) => {
                        const { data, status } = response;
                        if (data.success) {
                            // todo: toastr success
                        }
                    })
                    .catch((e) => {
                        //errorHandler
                    });
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
                theme: this.setTheme,
                toast: this.toast,
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
