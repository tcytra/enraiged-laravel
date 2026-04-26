<template>
    <vue-form ref="vueForm"
        :creating="creating"
        :template="template"
        :updating="updating"
        @form:success="formSuccess" />
</template>

<script setup>
import { ref } from 'vue';
import { useMessages } from '@/handlers/messages';
import VueForm from '@/components/forms/VueForm.vue';

const props = defineProps({
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

const vueForm = ref();

const formSuccess = () => {
    const form = vueForm.value.form;
    form.password = null;
    form.password_confirmation = null;
    form.defaults();
};
</script>
