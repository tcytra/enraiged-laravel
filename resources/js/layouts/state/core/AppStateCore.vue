<script>
export default {
    emits: ['close:all', 'close:auth', 'close:menu'],

    props: {
        auth: {
            type: Object,
            required: true,
        },
    },

    data: () => ({
        appReady: false,
        authOpen: false,
        menuOpen: null,
    }),

    computed: {
        clientState() {
            const state = {
                'lg': this.client.lg,
                'md': this.client.md,
                'sm': this.client.sm,
                'xl': this.client.xl,
                'xs': this.client.xs,
                'xxl': this.client.xxl,
            };

            return Object.keys(state)
                .filter(key => state[key])
                .join('');
        },

        isMobile() {
            return ['sm', 'xs'].includes(this.clientState);
        },

        isTablet() {
            return ['lg', 'md'].includes(this.clientState);
        },

        menuState() {
            const state = {
                'auth-open': this.authOpen,
                'menu-open': this.menuOpen === true,
                'menu-closed': this.menuOpen === false,
            };

            return Object.keys(state)
                .filter(key => state[key])
                .join(' ');
        },

        panelState() {
            return {
                auth: this.authOpen,
                menu: this.menuOpen,
            };
        },
    },

    inject: ['client', 'success'],

    created() {
        this.loadAppState();
    },

    methods: {
        closeAll() {
            this.authOpen = false;
            this.menuOpen = false;
        },

        closeAuth() {
            this.authOpen = false;
        },

        closeMenu() {
            this.menuOpen = false;
        },

        fetched(response) {
            this.appReady = true;
            const { status, data } = response;
            if (this.success(status)) {
                const lang = this.auth.user.language;
                this.$root.$i18n.locale = lang;
                this.$root.$i18n.setLocaleMessage(lang, data.i18n[lang]);
            }
        },

        loadAppState() {
            this.axios.get('/api/app/state')
                .then(response => this.fetched(response));
        },

        toggleAuth() {
            this.authOpen = !this.authOpen;
        },

        toggleMenu() {
            if (this.authOpen) {
                this.authOpen = false;
                this.menuOpen = true;
            } else {
                this.menuOpen = this.menuOpen === null
                    ? ['sm', 'xs'].includes(this.clientState)
                    : !this.menuOpen;
            }
        },
    },

    provide() {
        return {
            isMobile: this.isMobile,
            loadAppState: this.loadAppState,
            panels: {
                closeAll: this.closeAll,
                closeAuth: this.closeAuth,
                closeMenu: this.closeMenu,
                toggleAuth: this.toggleAuth,
                toggleMenu: this.toggleMenu,
            },
        };
    },

    render() {
        return this.$slots.default({
            appReady: this.appReady,
            clientState: this.clientState,
            closeAuth: this.closeAuth,
            closeMenu: this.closeMenu,
            menuState: this.menuState,
            panelState: this.panelState,
            toggleAuth: this.toggleAuth,
            toggleMenu: this.toggleMenu,
        });
    },
};
</script>
