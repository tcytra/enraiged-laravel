<script>
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
        eventsAttach() {
            window.addEventListener('resize', this.resizeDocument);
        },

        eventsDetach() {
            window.removeEventListener('resize', this.resizeDocument);
        },

        resizeDocument() {
            this.clientWidth = document.documentElement.clientWidth;
        },

        isSuccess(status) {
            return status >= 200 && status < 300;
        },
    },

    provide() {
        return {
            clientSize: this.clientSize,
            i18n: this.$t,
            isSuccess: this.isSuccess,
        };
    },

    render() {
        return this.$slots.default({
            isGuest: this.isGuest,
        });
    },
};
</script>
