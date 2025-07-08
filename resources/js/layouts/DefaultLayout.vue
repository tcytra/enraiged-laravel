<template>
    <app-state ref="app" v-slot:default="app">
        <transition name="fade">
            <auth-state v-if="app.ready && app.auth">
                <slot />
            </auth-state>
        </transition>
        <transition name="fade">
            <guest-state v-if="app.ready && !app.auth">
                <slot />
            </guest-state>
        </transition>
        <transition name="fade">
            <load-state v-if="!app.ready"></load-state>
        </transition>
        <primevue-toast v-if="app.ready"
            :group="app.meta.toast.group"
            :position="app.meta.toast.position" />
    </app-state>
</template>

<script setup>
import AppState from './states/renderless/AppState.vue';
import AuthState from './states/AuthState.vue';
import GuestState from './states/GuestState.vue';
import LoadState from './states/LoadState.vue';
import PrimevueToast from 'primevue/toast';
</script>

<style scoped>
.fade-enter-active {
  transition: opacity 0.375s ease-out;
}

.fade-leave-active {
  transition: opacity 0.125s cubic-bezier(1, 0.5, 0.8, 1);
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
