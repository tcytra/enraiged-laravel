<template>
    <vue-form updating :template="template"/>
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
    },
};
</script>
