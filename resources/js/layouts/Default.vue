<template>
    <div class="default layout" :class="{
            'auth-open': authOpen,
            'menu-open': menuOpen === true,
            'menu-closed': menuOpen === false
        }">
        <main-menu ref="mainMenu" class="main menu" :menu-open="menuOpen"
            @toggle-menu="toggleMenu" />
        <div class="main page" ref="mainPage">
            <top-nav ref="topNav" :auth-open="authOpen"
                @toggle-auth="toggleAuth"
                @toggle-menu="toggleMenu" />
            <slot />
        </div>
        <auth-panel class="auth panel" :auth-open="authOpen"
            @toggle-auth="toggleAuth"/>
    </div>
</template>

<script>
import AuthPanel from '@/components/auth/Panel.vue';
import MainMenu from '@/components/menus/MainMenu.vue';
import TopNav from '@/components/menus/TopNav.vue';

export default {
    components: {
        AuthPanel,
        MainMenu,
        TopNav,
    },
    props: {
        auth: Object,
    },
    data() {
        return {
            authOpen: false,
            menuOpen: null,
        };
    },
    methods: {
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
