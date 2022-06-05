<script>
import { computed } from 'vue';

export default {
    emits: ['close:all', 'close:auth', 'close:menu'],

    inject: ['clientSize', 'isSuccess'],

    props: {
        auth: {
            type: Object,
            required: true,
        },
    },

    data: () => ({
        appMenu: null,
        appReady: false,
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
        this.loadAppState();
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

        fetched(response) {
            const { status, data } = response;
            if (this.isSuccess(status)) {
                const { i18n, menu, meta } = data;
                const lang = this.auth.user.language;
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

        loadAppState() {
            this.axios.get('/api/app/state')
                .then(response => this.fetched(response));
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
            closeAllPanels: this.closeAll,
            closeAuthPanel: this.closeAuth,
            closeMainPanel: this.closeMenu,
            isMobile: computed(() => this.isMobile),
            isTablet: computed(() => this.isTablet),
            loadAppState: this.loadAppState,
            toggleAuthPanel: this.toggleAuth,
            toggleMainPanel: this.toggleMenu,
        };
    },

    render() {
        return this.$slots.default({
            appClasses: [this.clientClass, this.menuClass],
            appReady: this.appReady,
            closeAuth: this.closeAuth,
            closeMenu: this.closeMenu,
            toggleAuth: this.toggleAuth,
            toggleMenu: this.toggleMenu,
        });
    },
};
</script>
