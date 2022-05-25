<script>
export default {
    inject: ['appMenu'],

    methods: {
        navigate(item) {
            for (const key of Object.keys(this.appMenu)) {
                if (this.appMenu[key].menu && key !== item) {
                    this.appMenu[key].open = false;
                }
            }
        },
    },

    render() {
        return this.$slots.default({
            menu: this.appMenu,
            navigate: this.navigate,
        });
    },
};
</script>
