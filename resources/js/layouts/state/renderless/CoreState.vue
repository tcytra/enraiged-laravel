<script>
import { computed } from 'vue';

export default {
    emits: ['close:all', 'close:auth', 'close:menu'],

    inject: ['clientSize', 'isSuccess'],

    props: {
        api: {
            type: String,
            required: true,
        },
    },

    data: () => ({
        appMenu: null,
        appMeta: null,
        appReady: false,
        appUser: null,
        authMenuOpen: false,
        mainMenuOpen: null,
    }),

    computed: {
        clientClass() {
            const clientClass = {
                'lg': this.clientSize.lg,
                'md': this.clientSize.md,
                'sm': this.clientSize.sm,
                'xl': this.clientSize.xl,
                'xs': this.clientSize.xs,
                'xxl': this.clientSize.xxl,
            };

            return Object.keys(clientClass)
                .filter(key => clientClass[key])
                .join('');
        },

        isMobile() {
            return ['sm', 'xs'].includes(this.clientClass);
        },

        isTablet() {
            return ['lg', 'md'].includes(this.clientClass);
        },

        menuClass() {
            const menuClass = {
                'auth-open': this.authMenuOpen,
                'menu-open': this.mainMenuOpen === true,
                'menu-closed': this.mainMenuOpen === false,
            };

            return Object.keys(menuClass)
                .filter(key => menuClass[key])
                .join(' ');
        },
    },

    created() {
        this.initState();
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

        initState() {
            this.axios.get(this.api)
                .then(response => this.fetched(response));
        },

        fetched(response) {
            const { status, data } = response;
            if (this.isSuccess(status)) {
                const { auth, i18n, menu, meta } = data;
                let lang = meta.language;
                if (auth) {
                    lang = auth.user.language;
                    this.setUser(auth.user);
                }
                this.$root.$i18n.locale = lang;
                this.$root.$i18n.setLocaleMessage(lang, i18n[lang]);
                Object.keys(menu).forEach(key => {
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
                this.appMenu = menu;
                this.appMeta = meta;
                this.appReady = true;
            }
        },

        setUser(user) {
            this.appUser = user;
        },

        stopImpersonating() {
            this.$inertia.get('/accounts/impersonate/stop');
            // this.axios.request({ method: 'get', url: '/accounts/impersonate/stop' })
            // .then(() => this.initState());
        },

        toggleAuth() {
            this.authMenuOpen = !this.authMenuOpen;
        },

        toggleMenu() {
            if (this.authMenuOpen) {
                this.authMenuOpen = false;
                this.mainMenuOpen = true;
            } else {
                this.mainMenuOpen = this.mainMenuOpen === null
                    ? this.isMobile
                    : !this.mainMenuOpen;
            }
        },
    },

    provide() {
        return {
            appMenu: computed(() => this.appMenu),
            appMeta: computed(() => this.appMeta),
            closeAllPanels: this.closeAll,
            closeAuthPanel: this.closeAuth,
            closeMainPanel: this.closeMenu,
            isMobile: computed(() => this.isMobile),
            isTablet: computed(() => this.isTablet),
            loadAppState: this.loadAppState,
            stopImpersonating: this.stopImpersonating,
            toggleAuthPanel: this.toggleAuth,
            toggleMainPanel: this.toggleMenu,
            user: computed(() => this.appUser),
        };
    },

    render() {
        return this.$slots.default({
            appClasses: [this.clientClass, this.menuClass],
            appReady: this.appReady,
            appUser: this.appUser,
            closeAuth: this.closeAuth,
            closeMenu: this.closeMenu,
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
