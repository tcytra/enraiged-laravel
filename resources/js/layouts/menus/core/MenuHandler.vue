<script>
export default {
    inject: ['menu', 'closeMainPanel', 'isMobile'],

    methods: {
        navigate(item) {
            for (const key of Object.keys(this.menu)) {
                if (this.menu[key].menu && key !== item) {
                    this.menu[key].open = false;
                }
            }
            if (this.isMobile) {
                this.closeMainPanel();
            }
        },
    },

    render() {
        return this.$slots.default({
            menu: this.menu,
            navigate: this.navigate,
        });
    },
};
</script>
