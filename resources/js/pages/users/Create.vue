<template>
    <main class="content main">
        <page-header back-button fixed :title="i18n('Create User')" />

        <section class="section form mx-auto max-w-lg">
            <user-form custom-actions creating success="The user account has been created." ref="form"
                :template="template" />
        </section>

        <footer class="footer">
            <form-actions v-if="ready"
                :form="form.$refs.userForm"
                :template="template" />
        </footer>
    </main>
</template>

<script setup>
import DefaultLayout from '@/layouts/DefaultLayout.vue';
import { Head as HtmlHead } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import { useLocales } from '@/handlers/locales';
import FormActions from '@/components/forms/VueFormActions.vue';
import PageHeader from '@/components/ui/PageHeader.vue';
import PrimevueCard from 'primevue/card';
import UserForm from '@/components/users/forms/UserForm.vue';

defineOptions({
    layout: DefaultLayout,
});

defineProps({
    template: {
        type: Object,
        required: true,
    },
});

const { i18n } = useLocales();

const form = ref();

const ready = ref(false);

onMounted(() => {
    ready.value = true;
});
</script>
