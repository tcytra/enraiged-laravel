<script>
export default {
    inject: ['i18n'],

    props: {
        form: {
            type: Object,
            required: true,
        },
        section: {
            type: Object,
            required: true,
        },
    },

    computed: {
        fields() {
            return this.section.fields;
        },
        heading() {
            return this.section.heading;
        },
    },

    render() {
        return this.$slots.default({
            fields: this.fields,
            form: this.form,
            heading: this.i18n(this.heading),
        });
    },
};    
</script>
