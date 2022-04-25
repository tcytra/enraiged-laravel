<script>
export default {
    props: {
        field: {
            type: Object,
            required: true,
        },
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
            return this.form ? this.form.errors[this.id] : null;
        },
        label() {
            return this.field.label;
        },
        placeholder() {
            return this.field.placeholder;
        },
    },

    methods: {
        update(value) {
            /*if (value && typeof value === 'object') {
                //  todo: must be a better way to handle this
                if (typeof value.code !== 'undefined') {
                    this.form[this.id] = value.code;
                }
            } else {
                this.form[this.id] = value;
            }*/
            this.form[this.id] = value;
        }
    },

    render() {
        return this.$slots.default({
            error: this.error,
            form: this.form,
            label: this.label,
            placeholder: this.placeholder,
            update: this.update,
        });
    },
};    
</script>
