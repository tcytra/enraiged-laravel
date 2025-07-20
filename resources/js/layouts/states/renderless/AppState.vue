<script>
import { computed } from 'vue';
import { trans, getActiveLanguage, loadLanguageAsync } from 'laravel-vue-i18n';

export default {
    data: () => ({
        auth: false,
        menu: null,
        meta: null,
        ready: false,
    }),
    // async created() {
    //     await this.fetchState();
    // },
    created() {
        this.fetchState();
    },
    methods: {
        async fetchState() {
            await axios.get(route('app.state'))
                .then((response) => {
                    const { data } = response;
                    this.auth = data.auth;
                    this.menu = data.menu;
                    this.meta = data.meta;
                    this.ready = true;
                });
        },
    },
    provide() {
        return {
            app: {
                auth: computed(() => this.auth),
                meta: computed(() => this.meta),
                state: this.fetchState,
            },
            intl: {
                ai18n: loadLanguageAsync,
                i18n: trans,
                lang: getActiveLanguage,
            },
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
