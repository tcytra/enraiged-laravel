<template>
    <guest-state v-if="!isAuthenticated">
        <slot/>
    </guest-state>
    <verify-state v-else-if="!isVerified">
        <slot/>
    </verify-state>
    <auth-state v-else>
        <slot/>
    </auth-state>
    <confirm-dialog/>
    <primevue-toast position="bottom-right" group="br"/>
</template>

<script>
import { computed } from 'vue';
import AuthState from './states/AuthState.vue';
import GuestState from './states/GuestState.vue';
import VerifyState from './states/VerifyState.vue';
import ConfirmDialog from 'primevue/confirmdialog';
import PrimevueToast from 'primevue/toast';

export default {
    components: {
        AuthState,
        ConfirmDialog,
        GuestState,
        PrimevueToast,
        VerifyState,
    },

    data: () => ({
        clientWidth: typeof document !== 'undefined'
            ? document.documentElement.clientWidth
            : 0,
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
            return this.$page.props.auth !== null;
        },
        isVerified(){
            return this.$page.props.meta.must_verify_email === false
                || this.$page.props.meta.has_verified_email === true;
        },
        isDesktop() {
            return !['md', 'sm', 'xs'].includes(this.clientSize);
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
        this.handleFlash();
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

        back() {
            window.history.go(-1);
        },

        documentSize() {
            if (typeof document !== 'undefined') {
                this.clientWidth = document.documentElement.clientWidth;
            }
        },

        errorHandler(error) {
            if (error.response) {
                const { message, response } = error;
                const { data, status } = response;
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
            } else {
                // console.log(error);
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
                this.$toast.add(message);
            } else {
                this.flashInfo(message);
            }
        },

        flashError(message) {
            this.flash({ detail: message, group: 'br', life: 3000, severity: 'error' });
        },

        flashInfo(message) {
            this.flash({ detail: message, group: 'br', life: 3000, severity: 'info' });
        },

        flashSuccess(message) {
            this.flash({ detail: message, group: 'br', life: 3000, severity: 'success' });
        },

        flashWarning(message) {
            this.flash({ detail: message, group: 'br', life: 3000, severity: 'warn' });
        },

        handleFlash() {
            const flash = this.$page.props.flash;
            if (flash.message) {
                this.flash(flash.message);
            }
            if (flash.success) {
                this.flashSuccess(flash.success);
            }
            if (flash.warning) {
                this.flashWarning(flash.warning);
            }
        },

        isSuccess(status) {
            return status >= 200 && status < 300;
        },

        padNumber(value) {
            const number = parseInt(value, 10);
            return (number < 10 ? `0${number}` : number).toString();
        },
    },

    provide() {
        return {
            actionHandler: this.actionHandler,
            back: this.back,
            clientSize: computed(() => this.clientSize),
            clientWidth: computed(() => this.clientWidth),
            errorHandler: this.errorHandler,
            flash: this.flash,
            flashError: this.flashError,
            flashInfo: this.flashInfo,
            flashSuccess: this.flashSuccess,
            flashWarning: this.flashWarning,
            i18n: this.$t,
            isDesktop: computed(() => this.isDesktop),
            isMobile: computed(() => this.isMobile),
            isSuccess: this.isSuccess,
            isTablet: computed(() => this.isTablet),
        };
    },

    watch: {
        '$page.props.flash': {
            handler() {
                this.handleFlash();
            },
            deep: true,
        },
    },
};
</script>
