<template>
    <div class="default layout" :class="{
            'auth-open': authOpen,
            'menu-open': menuOpen === true,
            'menu-closed': menuOpen === false,
            'xs': clientWidth < 417,
            'sm': clientWidth > 416 && clientWidth < 577,
            'md': clientWidth > 576 && clientWidth < 993,
            'lg': clientWidth > 992 && clientWidth < 1185,
            'xl': clientWidth > 1184,
        }">
        <main-menu ref="mainMenu" class="main menu" :menu-open="menuOpen"
            @toggle-menu="toggleMenu" />
        <div class="main page bg-bluegray-100" ref="mainPage">
            <top-nav ref="topNav" :auth-open="authOpen"
                @toggle-auth="toggleAuth"
                @toggle-menu="toggleMenu" />
            <slot />
        </div>
        <!--<auth-panel class="auth panel" :auth-open="authOpen"
            @toggle-auth="toggleAuth"/>-->
    </div>
</template>

<script>
// import AuthPanel from '@/components/auth/Panel';
import MainMenu from '@/components/menus/MainMenu';
import TopNav from '@/components/menus/TopNav';

export default {
    components: {
        // AuthPanel,
        MainMenu,
        TopNav,
    },
    data: () => ({
        authOpen: false,
        clientWidth: document.documentElement.clientWidth,
        menuOpen: null,
    }),
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
        detachEvents() {
            window.removeEventListener('resize', this.resizeDocument);
        },
        resizeDocument() {
            this.clientWidth = document.documentElement.clientWidth;
        },
        toggleAuth() {
            this.authOpen = !this.authOpen;
        },
        toggleMenu() {
            // this.authOpen = false;
            this.menuOpen = this.menuOpen === null
                ? this.$refs.mainMenu.$el.clientWidth === 0
                : !this.menuOpen;
        },
    },
};
</script>
