<script>
import { format as dateFnsFormat } from 'date-fns'

export default {
    data: () => ({
        clientWidth: document.documentElement.clientWidth,
    }),

    computed: {
        clientSize() {
            return {
                lg: this.clientWidth > 992 && this.clientWidth < 1185,
                md: this.clientWidth > 576 && this.clientWidth < 993,
                sm: this.clientWidth > 416 && this.clientWidth < 577,
                xs: this.clientWidth < 417,
                xl: this.clientWidth > 1184 && this.clientWidth < 1535,
                xxl: this.clientWidth > 1536,
            };
        },

        isGuest() {
            return !this.$page.props.auth;
        },
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

        errorHandler(error) {
            // console.log(error);
        },

        eventsAttach() {
            window.addEventListener('resize', this.resizeDocument);
        },

        eventsDetach() {
            window.removeEventListener('resize', this.resizeDocument);
        },

        formatDate(value, format) {
            if (typeof format === 'undefined') {
                format = 'yyyy-MM-dd';
            }
            return dateFnsFormat(value, format);
        },

        isSuccess(status) {
            return status >= 200 && status < 300;
        },

        newDate(date) {
            return new Date(`${date} 00:00:00`);
        },

        padNumber(value) {
            const number = parseInt(value, 10);
            return (number < 10 ? `0${number}` : number).toString();
        },

        resizeDocument() {
            this.clientWidth = document.documentElement.clientWidth;
        },
    },

    provide() {
        return {
            actionHandler: this.actionHandler,
            clientSize: this.clientSize,
            errorHandler: this.errorHandler,
            formatDate: this.formatDate,
            i18n: this.$t,
            isSuccess: this.isSuccess,
            newDate: this.newDate,
        };
    },

    render() {
        return this.$slots.default({
            isGuest: this.isGuest,
        });
    },
};
</script>
