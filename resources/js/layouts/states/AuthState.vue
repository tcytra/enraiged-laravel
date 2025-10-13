<template>
    <div class="auth flex layout" :class="{
            'auth-open': app.auth.open,
            'menu-open': app.menu.open === true,
            'menu-closed': app.menu.open === false,
            'nav-over': app.meta.layout.nav === 'over',
            'nav-under': app.meta.layout.nav === 'under',
        }">
        <menu-panel class="menu panel" v-if="navOver"
            :menu="app.menu"
            :meta="app.meta" />
        <utility-bar class="bar utility" v-if="navUnder"
            :auth="app.auth"
            :menu="app.menu"
            :meta="app.meta"
            :theme="app.theme" />
        <div class="page panel">
            <menu-panel class="menu panel" v-if="navUnder"
                :menu="app.menu"
                :meta="app.meta" />
            <utility-bar class="bar utility" v-if="navOver"
                :auth="app.auth"
                :menu="app.menu"
                :meta="app.meta"
                :theme="app.theme" />
            <slot />
            <auth-panel class="auth panel" v-if="authPanel && navUnder"
                :auth="app.auth"
                :meta="app.meta" />
        </div>
        <auth-panel class="auth panel" v-if="authPanel && navOver"
            :auth="app.auth"
            :meta="app.meta" />
    </div>
</template>

<script setup>
import { computed } from 'vue';
import AuthPanel from '@/layouts/panels/AuthPanel.vue';
import MenuPanel from '@/layouts/panels/MenuPanel.vue';
import UtilityBar from '@/layouts/panels/UtilityBar.vue';

const props = defineProps({
    app: {
        type: Object,
        required: true,
    },
});

const layout = props.app.meta.layout;

const authPanel = computed(() => layout.auth === 'panel');
const navOver = computed(() => layout.nav === 'over');
const navUnder = computed(() => layout.nav === 'under');
</script>
