<script>
import { computed, createApp } from 'vue';
import { i18nVue } from 'laravel-vue-i18n';
import { router } from '@inertiajs/vue3';

export default {
    emits: ['close:all', 'close:auth', 'close:menu'],

    inject: ['isMobile', 'isSuccess'],

    props: {
        api: {
            type: String,
            required: true,
        },
    },

    data: () => ({
        auth: null,
        authMenuOpen: false,
        mainMenuOpen: false,
        menu: null,
        meta: null,
    }),

    computed: {
        menuClass() {
            const state = {
                'auth-open': this.authMenuOpen,
                'menu-open': this.mainMenuOpen === true,
                'menu-closed': this.mainMenuOpen === false,
            };

            return Object.keys(state)
                .filter((value) => state[value] === true)
                .join(' ');
        },
    },

    created() {
        this.mainMenuOpen = (this.isMobile !== true);
        this.setAuth(this.$page.props.auth);
        this.setMenu(this.$page.props.menu);
        this.setMeta(this.$page.props.meta);
        if (this.auth !== null) {
            this.setLanguage(this.auth.language);
            this.setTheme(this.auth.thema);
        }
    },

    methods: {
        closeAll() {
            this.authMenuOpen = false;
            this.mainMenuOpen = false;
        },

        closeAuth() {
            this.authMenuOpen = false;
        },

        closeMenu() {
            this.mainMenuOpen = false;
        },

        currentTheme() {
            if (typeof document !== 'undefined') {
                let href = document.getElementById('theme-color').href;
                href = href.substr(0, href.lastIndexOf('/'));
                return href.substr(href.lastIndexOf('/') +1);
            }
        },

        initState() {
            if (typeof document !== 'undefined') {
                axios.get(this.api)
                    .then(response => this.fetched(response));
            }
        },

        fetched(response) {
            const { status, data } = response;
            if (this.isSuccess(status)) {
                const { auth, menu, meta } = data;
                if (auth) {
                    this.setLanguage(auth.language);
                    this.setTheme(auth.theme);
                }
                this.setAuth(auth);
                this.setMenu(menu);
                this.setMeta(meta);
            }
        },

        logout() {
            const app_theme = this.currentTheme();
            if (app_theme !== this.meta.app_theme) {
                this.$primevue.changeTheme(app_theme, this.meta.app_theme, 'theme-color', () => {});
            }
            router.post('/logout');
        },

        setAuth(auth) {
            this.auth = auth;
        },

        setLanguage(language) {
            const app = createApp({});
            app.use(i18nVue, {
                lang: language,
            });
        },

        setMenu(menu) {
            if (menu) {
                Object.keys(menu).forEach(key => {
                    if (menu[key].prefix) {
                        if (this.$page.url.indexOf(menu[key].prefix) === 0) {
                            menu[key].open = true;
                        }
                    } else
                    if (menu[key].menu) {
                        let state = false;
                        Object.values(menu[key].menu).every(item => {
                            if (item.route === this.$page.url) {
                                state = true;
                            }
                        });
                        menu[key].open = state;
                    }
                });
            }
            this.menu = menu;
        },

        setMeta(meta) {
            this.meta = meta;
            this.setTheme(meta.app_theme);
        },

        setTheme(theme) {
            if (typeof theme !== 'undefined') {
                this.$primevue.changeTheme(this.currentTheme(), theme, 'theme-color', () => {});
            }
        },

        stopImpersonating() {
            this.$inertia.get('/users/impersonate/stop');
        },

        toggleAuth() {
            this.authMenuOpen = !this.authMenuOpen;
        },

        toggleMenu() {
            if (this.authMenuOpen) {
                this.authMenuOpen = false;
                this.mainMenuOpen = true;
            } else {
                this.mainMenuOpen = !this.mainMenuOpen;
            }
        },
    },

    provide() {
        return {
            auth: computed(() => this.auth),
            closeAllPanels: this.closeAll,
            closeAuthPanel: this.closeAuth,
            closeMainPanel: this.closeMenu,
            currentTheme: this.currentTheme,
            initState: this.initState,
            logout: this.logout,
            menu: computed(() => this.menu),
            meta: computed(() => this.meta),
            setLanguage: this.setLanguage,
            setTheme: this.setTheme,
            stopImpersonating: this.stopImpersonating,
            toggleAuthPanel: this.toggleAuth,
            toggleMainPanel: this.toggleMenu,
        };
    },

    render() {
        return this.$slots.default({
            closeAuth: this.closeAuth,
            closeMenu: this.closeMenu,
            menuClasses: this.menuClass,
            toggleAuth: this.toggleAuth,
            toggleMenu: this.toggleMenu,
        });
    },

    watch: {
        '$page.props.flash': {
            handler() {
                const flash = this.$page.props.flash;
                switch (flash.status) {
                    case 205:
                        this.initState();
                        break;
                }
            },
            deep: true,
        },
    },
};
</script>
