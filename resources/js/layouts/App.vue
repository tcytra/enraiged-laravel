<template>
    <app-core>
        <template v-slot:default="{ isGuest }">
            <guest-state key="guest" :meta="meta" v-if="isGuest">
                <slot/>
            </guest-state>
            <app-state key="app" :auth="auth" :meta="meta" v-else>
                <slot/>
            </app-state>
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

    props: {
        auth: Object,
        meta: Object,
    },
};
</script>
