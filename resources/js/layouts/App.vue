<template>
    <Transition>
        <guest-state ref="guest" v-if="isGuest"
            :meta="meta">
            <slot  />
        </guest-state>
        <app-state ref="app" v-else
            :auth="auth"
            :meta="meta"
            @close:all="closeAll"
            @close:auth="closeAuth"
            @close:menu="closeMenu">
            <slot />
        </app-state>
    </Transition>
    <confirm-dialog />
    <flash-messages />
</template>

<script>
import AppState from './state/AppState';
import ConfirmDialog from 'primevue/confirmdialog';
import GuestState from './state/GuestState';
import FlashMessages from './notifications/FlashMessages';

export default {
    components: {
        AppState,
        ConfirmDialog,
        GuestState,
        FlashMessages,
    },

    props: {
        auth: Object,
        meta: Object,
    },

    computed: {
        isGuest() {
            return !this.auth;
        },
    },

    methods: {
        closeAll() {
            this.$refs.app.closeAll();
        },
        closeAuth() {
            this.$refs.app.closeAuth();
        },
        closeMenu() {
            this.$refs.app.closeMenu();
        },
    },
};
</script>

<style>
.v-enter-active,
.v-leave-active {
    transition: opacity 0.25s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}    
</style>
