<template>
    <core-state :api="uri">
        <template v-slot:default="{
                appClasses, appReady, appUser, closeAuth, closeMenu, toggleAuth, toggleMenu,
            }">
            <div class="default layout" key="layout" v-if="appReady"
                :class="appClasses">
                <main-panel class="main panel" ref="mainPanel"
                    @menu:toggle="toggleMenu"/>
                <div class="main page" ref="mainPage">
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
        </template>
    </core-state>
</template>

<script>
import CoreState from './renderless/CoreState';
import AuthPanel from '../panels/AuthPanel';
import MainPanel from '../panels/MainPanel';
import TopNav from '../menus/TopNav';
import VueProgressSpinner from 'primevue/progressspinner';

export default {
    components: {
        CoreState,
        AuthPanel,
        MainPanel,
        TopNav,
        VueProgressSpinner,
    },

    data: () => ({
        uri: '/api/app/state',
    }),
};
</script>
