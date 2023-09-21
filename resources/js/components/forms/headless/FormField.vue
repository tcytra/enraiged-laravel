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
            const disabled = this.field.disabled || this.$props.disabled;
            if (typeof this.field.disabledUnless !== 'undefined') {
                return this.determineUnless(this.field.disabledUnless, disabled);
            } else
            if (typeof this.field.disabledIf !== 'undefined') {
                return this.determineIf(this.field.disabledIf, disabled);
            }
            return disabled;
        },
        isHidden() {
            let hidden = this.field.hidden || this.$props.hidden;
            if (typeof this.field.hiddenUnless !== 'undefined') {
                return this.determineUnless(this.field.hiddenUnless, hidden);
            } else
            if (typeof this.field.hiddenIf !== 'undefined') {
                return this.determineIf(this.field.hiddenIf, hidden);
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
        determineIf(argument, value) {
            if (typeof argument === 'object' && Array.isArray(argument)) {
                for (let i = 0; i < argument.length; i++) {
                    if (this.determineIf(argument[i])) {
                        return true;
                    }
                }
                return false;
            } else
            if (typeof argument === 'object') {
                const field = Object.keys(argument).shift();
                return this.form[field] === argument[field];
            } else
            if (typeof argument === 'string') {
                return this.form[argument] !== null;
            }
            return value;
        },
        determineUnless(argument, value) {
            if (typeof argument === 'object' && Array.isArray(argument)) {
                for (let i = 0; i < argument.length; i++) {
                    if (!this.determineUnless(argument[i])) {
                        return false;
                    }
                }
                return true;
            } else
            if (typeof argument === 'object') {
                const field = Object.keys(argument).shift();
                return this.form[field] !== argument[field];
            } else
            if (typeof argument === 'string') {
                return this.form[argument] === null;
            }
            return value;
        },
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
