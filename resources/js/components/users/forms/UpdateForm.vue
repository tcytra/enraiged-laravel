<template>
    <vue-form ref="updateForm"
        :template="template"
        :updating="updating"/>
</template>

<script>
import VueForm from '@/components/forms/VueForm.vue';

export default {
    components: {
        VueForm,
    },

    props: {
        template: {
            type: Object,
            required: true,
        },
        updating: {
            type: Boolean,
            default: false,
        },
    },
};
</script>
