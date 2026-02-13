<template>
    <vue-form ref="vueForm"
        :creating="creating"
        :template="template"
        :updating="updating" />
</template>

<script setup>
import VueForm from '@/components/forms/VueForm.vue';

defineProps({
    creating: {
        type: Boolean,
        default: false,
    },
    template: {
        type: Object,
        required: true,
    },
    updating: {
        type: Boolean,
        default: false,
    },
});
</script>
