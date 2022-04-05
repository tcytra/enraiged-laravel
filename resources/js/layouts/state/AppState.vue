<template>
    <div class="default layout"
        :class="{
            'auth-open': authOpen,
            'menu-open': menuOpen === true,
            'menu-closed': menuOpen === false,
            'lg': clientLarge,
            'md': clientMedium,
            'sm': clientSmall,
            'xl': clientExtraLarge,
            'xs': clientExtraSmall,
            'xxl': clientExtra,
        }">
        <menu-panel class="menu panel" ref="menuPanel"
            :meta="meta"
            @menu:navigate="menuNavigation"
            @menu:toggle="toggleMenu" />
        <div class="main page" ref="mainPage"
            v-on:auth:close="closeAuth">
            <top-nav
                @auth:toggle="toggleAuth"
                @menu:toggle="toggleMenu" />
            <slot />
        </div>
        <auth-panel class="auth panel" ref="authPanel"
            :auth="auth"
            @auth:toggle="toggleAuth"/>
    </div>
</template>

<script>
import AuthPanel from '../panels/AuthPanel';
import MenuPanel from '../panels/MenuPanel';
import TopNav from '../menus/TopNav';

export default {
    components: {
        AuthPanel,
        MenuPanel,
        TopNav,
    },

    props: {
        auth: {
            type: Object,
            required: true,
        },
        meta: {
            type: Object,
            required: true,
        },
    },

    data: () => ({
        authOpen: false,
        clientWidth: document.documentElement.clientWidth,
        menuOpen: null,
    }),

    computed: {
        clientExtra() {
            return this.clientWidth > 1536;
        },
        clientExtraLarge() {
            return this.clientWidth > 1184 && this.clientWidth < 1535;
        },
        clientExtraSmall() {
            return this.clientWidth < 417;
        },
        clientLarge() {
            return this.clientWidth > 992 && this.clientWidth < 1185;
        },
        clientMedium() {
            return this.clientWidth > 576 && this.clientWidth < 993;
        },
        clientSmall() {
            return this.clientWidth > 416 && this.clientWidth < 577;
        },
    },

    mounted() {
        this.attachEvents();
    },

    unmounted() {
        this.detachEvents();
    },

    methods: {
        attachEvents() {
            window.addEventListener('resize', this.resizeDocument);
        },
        closeAll() {
            this.authOpen = false;
        },
        closeAuth() {
            this.authOpen = false;
        },
        closeMenu() {
            this.menuOpen = false;
        },
        detachEvents() {
            window.removeEventListener('resize', this.resizeDocument);
        },
        menuNavigation() {
            if (this.clientExtraSmall || this.clientSmall) {
                this.closeMenu();
            }
        },
        resizeDocument() {
            this.clientWidth = document.documentElement.clientWidth;
        },
        toggleAuth() {
            this.authOpen = !this.authOpen;
            if ([].includes()) {
                
            }
        },
        toggleMenu() {
            if (this.authOpen) {
                this.authOpen = false;
                this.menuOpen = true;
            } else {
                this.menuOpen = this.menuOpen === null
                    ? this.$refs.menuPanel.$el.clientWidth === 0
                    : !this.menuOpen;
            }
        },
    },
};
</script>
