<template>
    <auth-state v-if="isAuthenticated">
        <slot/>
    </auth-state>
    <guest-state v-else>
        <slot/>
    </guest-state>
    <confirm-dialog/>
    <flash-messages :messages="flashMessages" @unflash="unflash"/>
</template>

<script>
import { computed } from 'vue';
import AuthState from './states/AuthState.vue';
import GuestState from './states/GuestState.vue';
import ConfirmDialog from 'primevue/confirmdialog/ConfirmDialog.vue';
import FlashMessages from './notifications/FlashMessages.vue';

export default {
    components: {
        AuthState,
        ConfirmDialog,
        GuestState,
        FlashMessages,
    },

    data: () => ({
        clientWidth: typeof document !== 'undefined'
            ? document.documentElement.clientWidth
            : 0,
        flashMessages: [],
    }),

    computed: {
        clientSize(){
            const size = {
                xs: this.clientWidth < 417,
                sm: this.clientWidth > 416 && this.clientWidth < 577,
                md: this.clientWidth > 576 && this.clientWidth < 993,
                lg: this.clientWidth > 992 && this.clientWidth < 1185,
                xl: this.clientWidth > 1184 && this.clientWidth < 1535,
                xxl: this.clientWidth > 1536,
            };
            return Object.keys(size)
                .filter((value) => size[value] === true)
                .join('');
        },
        isAuthenticated(){
            return this.$page.props.auth;
        },
        isMobile() {
            return ['sm', 'xs'].includes(this.clientSize);
        },
        isTablet() {
            return this.clientSize === 'md';
        },
    },

    created() {
        this.documentSize();
    },

    mounted() {
        this.eventsAttach();
    },

    unmounted() {
        this.eventsDetach();
    },

    methods: {
        actionHandler(action, name) {
            if (typeof action === 'string') {
                this.$inertia.get(action);
            } else if (typeof action.uri !== 'undefined') {
                const method = action.method || 'get';
                this.$inertia[method](action.uri);
            } else {
                const actionName = name || 'action';
                this.$emit(actionName);
            }
        },

        documentSize() {
            if (typeof document !== 'undefined') {
                this.clientWidth = document.documentElement.clientWidth;
            }
        },

        errorHandler(error) {
            // const { message, response } = error;
            const { data, status } = error.response;
            switch (status) {
                case 404:
                    this.flashError(this.$t('The remote host responded with a page not found error'));
                    break;
                case 422:
                    this.flashWarning(data.message);
                    break;
                case 500:
                    this.flashError(data.message);
                    break;
            }
        },

        eventsAttach() {
            window.addEventListener('resize', this.documentSize);
        },

        eventsDetach() {
            window.removeEventListener('resize', this.documentSize);
        },

        flash(message) {
            if (typeof message === 'object') {
                this.flashMessages.push(message);
            } else {
                this.flashSuccess(message);
            }
        },

        flashError(message) {
            this.flashMessages.push({ severity: 'error', content: message, expiry: 3000 });
        },

        flashInfo(message) {
            this.flashMessages.push({ severity: 'info', content: message, expiry: 3000 });
        },

        flashSuccess(message) {
            this.flashMessages.push({ severity: 'success', content: message, expiry: 3000 });
        },

        flashWarning(message) {
            this.flashMessages.push({ severity: 'warn', content: message, expiry: 3000 });
        },

        isSuccess(status) {
            return status >= 200 && status < 300;
        },

        padNumber(value) {
            const number = parseInt(value, 10);
            return (number < 10 ? `0${number}` : number).toString();
        },

        unflash(index) {
            this.flashMessages.splice(index, 1);
        },
    },

    provide() {
        return {
            actionHandler: this.actionHandler,
            clientSize: computed(() => this.clientSize),
            clientWidth: computed(() => this.clientWidth),
            errorHandler: this.errorHandler,
            flash: this.flash,
            flashError: this.flashError,
            flashInfo: this.flashInfo,
            flashSuccess: this.flashSuccess,
            flashWarning: this.flashWarning,
            i18n: this.$t,
            isMobile: computed(() => this.isMobile),
            isSuccess: this.isSuccess,
            isTablet: computed(() => this.isTablet),
        };
    },

    watch: {
        '$page.props.flash': {
            handler() {
                const flash = this.$page.props.flash;
                if (flash.message) {
                    this.flash(flash.message);
                }
                if (flash.success) {
                    this.flash(flash.success);
                }
            },
            deep: true,
        },
    },
};
</script>
