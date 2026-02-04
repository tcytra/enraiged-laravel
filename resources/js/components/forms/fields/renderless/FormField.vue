<script>
import { trans as i18n } from 'laravel-vue-i18n';

export default {
    props: {
        creating: {
            type: Boolean,
            default: false,
        },
        disabled: {
            type: Boolean,
            default: false,
        },
        feedback: {
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
        label: {
            type: String,
            default: null,
        },
        model: {
            default: null,
        },
        placeholder: {
            type: String,
            default: null,
        },
        required: {
            type: Boolean,
            default: false,
        },
        size: {
            type: String,
            default: null,
        },
        type: {
            type: String,
            default: null,
        },
        umask: {
            type: Boolean,
            default: false,
        },
        updating: {
            type: Boolean,
            default: false,
        },
    },

    emits: ['update:modelValue'],

    computed: {
        error() {
            return this.hasError ? this.form.errors[this.id] : null;
        },
        hasError() {
            return this.form && this.form.errors
                && this.id in this.form.errors;
        },
        hasLabel() {
            return this.label !== null
                || (typeof this.field.label !== 'undefined' && this.field.label !== null);
        },
        hasPlaceholder() {
            return this.placeholder !== null
                || (typeof this.field.placeholder !== 'undefined' && this.field.placeholder !== null);
        },
        i18n() {
            return i18n;
        },
        inputWidth() {
            const width = this.field.width || 'full';
            return `w-${width}`;
        },
        isCreating() {
            return this.isDirty && this.creating;
        },
        isDirty() {
            if (this.field.nodirty) {
                return false;
            }
            return (this.field.type === 'select' && this.field.multiple) || this.field.type === 'multiselect'
                ? this.form[this.id].join(',') !== this.field.value.join(',')
                : this.form[this.id] !== this.field.value;
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
        isUpdating() {
            return this.isDirty && this.updating;
        },
    },

    beforeCreate() {
        if (!Object.keys(this.field).includes('value')) {
            switch (this.field.type) {
                case 'calendar':
                    this.field.value = this.field.multiple || this.field.range
                        ? []
                        : null;
                    break;
                case 'checkbox':
                    this.field.value = false;
                    break;
                case 'listbox':
                    this.field.value = this.field.multiple
                        ? []
                        : null;
                    break;
                case 'switch':
                    this.field.value = false;
                    break;
                case 'multiselect':
                    this.field.value = [];
                    break;
                case 'select':
                    this.field.value = this.field.multiple
                        ? []
                        : null;
                    break;
                default:
                    this.field.value = null;
            }
        }
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
                return this.form[argument] !== null
                    && this.form[argument] !== false;
            }
            return value;
        },
        determineUnless(argument, value) {
            if (typeof argument === 'object' && Array.isArray(argument)) {
                let determined = 0;
                for (let i = 0; i < argument.length; i++) {
                    if (!this.determineUnless(argument[i])) {
                        determined++;
                    }
                }
                return argument.length > determined;
            } else
            if (typeof argument === 'object') {
                const field = Object.keys(argument).shift();
                return this.form[field] !== argument[field];
            } else
            if (typeof argument === 'string') {
                return this.form[argument] === null
                    || this.form[argument] === false;
            }
            return value;
        },
        update(payload) {
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
            if (typeof closure !== 'undefined') {
                // closure(); // todo: provide a means of realtime input processing
            }
            this.$emit('update:modelValue', payload);
        },
    },

    render() {
        return this.$slots.default({
            after: this.field.after,
            before: this.field.before,
            break: this.field.break,
            class: this.field.class,
            error: this.hasError ? i18n(this.error) : null,
            feedback: this.feedback === true || this.field.feedback === true,
            footer: this.field.footer || null,
            header: this.field.header || null,
            id: this.id,
            isCreating: this.isCreating,
            isDirty: this.isDirty,
            isDisabled: this.isDisabled,
            isHidden: this.isHidden,
            isUpdating: this.isUpdating,
            form: this.form,
            label: this.hasLabel ? i18n(this.label || this.field.label) : null,
            options: this.field.options,
            placeholder: this.hasPlaceholder ? i18n(this.placeholder || this.field.placeholder) : null,
            size: this.size || this.field.size,
            type: this.type || this.field.type || 'text',
            umask: this.umask === true || this.field.umask === true,
            update: this.update,
            width: this.inputWidth,
        });
    },
};
</script>
