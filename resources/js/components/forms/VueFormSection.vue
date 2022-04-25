<script>
export default {
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
            heading: this.heading,
        });
    },
};    
</script>
