<template>
    <app-state :api="uri">
        <template v-slot:default="{
                menuClasses, closeAuth, closeMenu, toggleAuth, toggleMenu,
            }">
            <transition enter-active-class="fadein" leave-active-class="fadeout">
                <div id="layout" class="default layout" key="layout"
                    :class="[menuClasses, clientSize]">
                    <main-panel class="main panel" ref="mainPanel"
                        @menu:toggle="toggleMenu"/>
                    <div id="page" class="main page" ref="mainPage">
                        <top-nav
                            @auth:toggle="toggleAuth"
                            @menu:toggle="toggleMenu"/>
                        <slot/>
                    </div>
                    <auth-panel class="auth panel" ref="authPanel"
                        @auth:close="closeAuth"
                        @auth:toggle="toggleAuth"/>
                </div>
            </transition>
        </template>
    </app-state>
</template>

<script>
import AppState from './renderless/AppState.vue';
import AuthPanel from '../panels/AuthPanel.vue';
import MainPanel from '../panels/MainPanel.vue';
import TopNav from '../menus/TopNav.vue';

export default {
    components: {
        AppState,
        AuthPanel,
        MainPanel,
        TopNav,
    },

    inject: [
        'clientSize',
    ],

    data: () => ({
        uri: '/api/app/state',
    }),
};
</script>
