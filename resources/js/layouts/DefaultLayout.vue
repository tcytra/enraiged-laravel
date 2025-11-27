<template>
    <app-state ref="app" v-slot:default="app">
        <transition name="fade">
            <auth-state :app="app" class="default" v-if="app.ready && app.auth.user">
                <slot />
            </auth-state>
        </transition>
        <transition name="fade">
            <guest-state class="default" v-if="app.ready && !app.auth.user">
                <slot />
            </guest-state>
        </transition>
        <transition name="fade">
            <load-state v-if="!app.ready"></load-state>
        </transition>
        <!--<primevue-toast v-if="app.ready"
            :group="app.toast.group" todo? group is causing issues
            :position="app.toast.position" />-->
        <primevue-toast v-if="app.ready"
            :position="app.toast.position" />
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
