<template>
    <app-state :api="uri">
        <template v-slot:default="{
                classes, menu, ready, closeAuth, closeMenu, toggleAuth, toggleMenu, user,
            }">
            <transition enter-active-class="fadein" leave-active-class="fadeout">
                <div id="layout" class="default layout" key="layout" v-if="ready"
                    :class="[classes, clientSize]">
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
                <div class="default overlay" key="overlay" v-else>
                    <vue-progress-spinner/>
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
import VueProgressSpinner from 'primevue/progressspinner/ProgressSpinner.vue';

export default {
    components: {
        AppState,
        AuthPanel,
        MainPanel,
        TopNav,
        VueProgressSpinner,
    },

    inject: [
        'clientSize',
    ],

    data: () => ({
        uri: '/api/app/state',
    }),
};
</script>
