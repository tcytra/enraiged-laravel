<script>
export default {
    inject: ['i18n'],

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
        disabled() {
            return this.field.disabled || false;
        },
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
            disabled: this.disabled,
            error: this.error,
            form: this.form,
            label: this.label ? this.i18n(this.label) : null,
            placeholder: this.placeholder ? this.i18n(this.placeholder) : null,
            update: this.update,
        });
    },
};    
</script>
