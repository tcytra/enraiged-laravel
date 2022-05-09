<script>
export default {
    data: () => ({
        width: document.documentElement.clientWidth,
    }),

    computed: {
        auth() {
            return this.$page.props.auth;
        },

        client() {
            return {
                lg: this.width > 992 && this.width < 1185,
                md: this.width > 576 && this.width < 993,
                sm: this.width > 416 && this.width < 577,
                xs: this.width < 417,
                xl: this.width > 1184 && this.width < 1535,
                xxl: this.width > 1536,
            };
        },

        guest() {
            return !this.auth;
        },

        meta() {
            return this.$page.props.meta;
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
            this.width = document.documentElement.clientWidth;
        },

        success(status) {
            return status >= 200 && status < 300;
        },
    },

    provide() {
        return {
            client: this.client,
            i18n: this.$t,
            success: this.success,
        };
    },

    render() {
        return this.$slots.default({
            auth: this.auth,
            guest: this.guest,
            meta: this.meta,
        });
    },
};
</script>
