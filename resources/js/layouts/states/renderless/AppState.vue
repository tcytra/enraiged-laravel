<script>
import { computed } from 'vue';
import { trans as i18n } from 'laravel-vue-i18n';

export default {
    data: () => ({
        auth: false,
        menu: null,
        meta: null,
        ready: false,
    }),
    async created() {
        const ready = await this.fetchState();
    },
    methods: {
        fetchState() {
            axios.get(route('app.state'))
                .then((response) => {
                    const { data } = response;
                    this.auth = data.auth;
                    this.menu = data.menu;
                    this.meta = data.meta;
                    this.ready = true;
                    return true;
                });
        },
    },
    provide() {
        return {
            auth: computed(() => this.auth),
            i18n: computed(() => this.i18n),
            meta: computed(() => this.meta),
            reset: this.fetchState,
        };
    },
    render() {
        return this.$slots.default({
            auth: this.auth,
            menu: this.menu,
            meta: this.meta,
            ready: this.ready,
        });
    },
    watch: {
        '$page.props.status': {
            handler(value) {
                //console.log(value);
                /*
                const status = this.$page.props.status;
                switch (status) {
                    case 205:
                        this.fetchState();
                        break;
                }
                */
            },
            deep: true,
        },
    },
};
</script>
