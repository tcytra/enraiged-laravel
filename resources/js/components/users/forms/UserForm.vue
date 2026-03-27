<template>
    <vue-form ref="updateForm"
        :creating="creating"
        :template="template"
        :updating="updating"
        @form:success="formSuccess" />
</template>

<script setup>
import { useMessages } from '@/handlers/messages';
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

const { flashSuccess } = useMessages();

const formSuccess = () => {
    flashSuccess('These details have been updated.');
};
</script>
