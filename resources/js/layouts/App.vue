<template>
    <app-core>
        <template v-slot:default="{ auth, guest, meta }">
            <app-state key="app" :auth="auth" :meta="meta" v-if="auth">
                <slot/>
            </app-state>
            <guest-state key="guest" :meta="meta" v-else>
                <slot/>
            </guest-state>
            <confirm-dialog/>
            <flash-messages/>
        </template>
    </app-core>
</template>

<script>
import AppCore from './AppCore';
import AppState from './state/AppState';
import ConfirmDialog from 'primevue/confirmdialog';
import GuestState from './state/GuestState';
import FlashMessages from './notifications/FlashMessages';

export default {
    components: {
        AppCore,
        AppState,
        ConfirmDialog,
        GuestState,
        FlashMessages,
    },
};
</script>
