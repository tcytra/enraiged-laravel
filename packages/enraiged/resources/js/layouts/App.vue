<template>
    <app-core>
        <template v-slot:default="{ isGuest }">
            <guest-state v-if="isGuest">
                <slot/>
            </guest-state>
            <auth-state v-else>
                <slot/>
            </auth-state>
            <confirm-dialog/>
            <flash-messages/>
        </template>
    </app-core>
</template>

<script>
import AppCore from './AppCore';
import AuthState from './state/AuthState';
import ConfirmDialog from 'primevue/confirmdialog';
import GuestState from './state/GuestState';
import FlashMessages from './notifications/FlashMessages';

export default {
    components: {
        AppCore,
        AuthState,
        ConfirmDialog,
        GuestState,
        FlashMessages,
    },
};
</script>
