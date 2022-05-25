<template>
    <app-state-core :auth="auth">
        <template v-slot:default="{
                appClasses, appReady, closeAuth, closeMenu, toggleAuth, toggleMenu,
            }">
            <transition>
                <div class="default layout" key="layout" v-if="appReady"
                    :class="appClasses">
                    <main-panel class="main panel" ref="mainPanel"
                        :meta="meta"
                        @menu:toggle="toggleMenu"/>
                    <div class="main page" ref="mainPage">
                        <top-nav
                            @auth:toggle="toggleAuth"
                            @menu:toggle="toggleMenu"/>
                        <slot/>
                    </div>
                    <auth-panel class="auth panel" ref="authPanel"
                        :auth="auth"
                        @auth:close="closeAuth"
                        @auth:toggle="toggleAuth"/>
                </div>
                <div class="default overlay" key="overlay" v-else>
                    <vue-progress-spinner/>
                </div>
            </transition>
        </template>
    </app-state-core>
</template>

<script>
import AppStateCore from './core/AppStateCore';
import AuthPanel from '../panels/AuthPanel';
import MainPanel from '../panels/MainPanel';
import TopNav from '../menus/TopNav';
import VueProgressSpinner from 'primevue/progressspinner';

export default {
    components: {
        AppStateCore,
        AuthPanel,
        MainPanel,
        TopNav,
        VueProgressSpinner,
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
};
</script>
