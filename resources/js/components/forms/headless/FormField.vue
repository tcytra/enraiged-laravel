<script>
export default {
    inject: ['i18n'],

    props: {
        disabled: {
            type: Boolean,
            default: false,
        },
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
            return this.form && this.form.errors ? this.form.errors[this.id] : null;
        },
        isDirty() {
            return this.form[this.id] !== this.field.value;
        },
        isDisabled() {
            let disabled = this.field.disabled || this.$props.disabled;
            if (typeof this.field.disabledUnless !== 'undefined') {
                const field = Object.keys(this.field.disabledUnless).shift();
                disabled = this.form[field] !== this.field.disabledUnless[field];
            } else
            if (typeof this.field.disabledIf !== 'undefined') {
                const field = Object.keys(this.field.disabledIf).shift();
                disabled = this.form[field] === this.field.disabledIf[field];
            }
            return disabled;
        },
        isHidden() {
            let hidden = this.field.hidden || false;
            if (typeof this.field.hiddenUnless !== 'undefined') {
                const field = Object.keys(this.field.hiddenUnless).shift();
                hidden = this.form[field] !== this.field.hiddenUnless[field];
            } else
            if (typeof this.field.hiddenIf !== 'undefined') {
                const field = Object.keys(this.field.hiddenIf).shift();
                hidden = this.form[field] === this.field.hiddenIf[field];
            }
            return hidden;
        },
        label() {
            return this.field.label;
        },
        placeholder() {
            return this.field.placeholder;
        },
    },

    methods: {
        update() {
            if (this.form[this.id] === '' && this.field.value === null) {
                this.form[this.id] = null;
            }
            if (this.form.errors) {
                if (this.form.errors[this.id]) {
                    delete this.form.errors[this.id];
                }
                if (!Object.keys(this.form.errors).length) {
                    this.form.hasErrors = false;
                }
            }
        },
    },

    render() {
        return this.$slots.default({
            error: this.error,
            isDirty: this.isDirty,
            isDisabled: this.isDisabled,
            isHidden: this.isHidden,
            form: this.form,
            label: this.label ? this.i18n(this.label) : null,
            placeholder: this.placeholder ? this.i18n(this.placeholder) : null,
            update: this.update,
        });
    },
};    
</script>
