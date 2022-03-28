<template>
    <Transition>
        <app-state v-if="auth">
            <slot />
        </app-state>
        <guest-state v-else>
            <slot />
        </guest-state>
    </Transition>
    <flash-messages />
</template>

<script>
import AppState from '@/layouts/state/AppState';
import GuestState from '@/layouts/state/GuestState';
import FlashMessages from '@/layouts/support/FlashMessages';

export default {
    components: {
        AppState,
        GuestState,
        FlashMessages,
    },
    props: {
        auth: [Object, null],
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
