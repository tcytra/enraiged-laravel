<script>
export default {
    props: {
        form: {
            type: Object,
            required: true,
        },
        id: {
            type: String,
            required: true,
        },
    },

    computed: {
        error() {
            return this.form.errors[this.id];
        },
    },

    methods: {
        update(value) {
            if (value && typeof value === 'object') {
                //  todo: must be a better way to handle this
                if (typeof value.code !== 'undefined') {
                    this.form[this.id] = value.code;
                }
            } else {
                this.form[this.id] = value;
            }
        }
    },

    render() {
        return this.$slots.default({
            error: this.error,
            update: this.update,
        });
    },
};    
</script>
