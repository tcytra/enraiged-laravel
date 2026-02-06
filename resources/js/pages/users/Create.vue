<template>
    <main class="content main">
        <page-header back-button fixed :title="i18n('Create User')" />

        <section class="section form mx-auto max-w-lg">
            <user-form creating :template="form" />
        </section>
    </main>
</template>

<script setup>
import DefaultLayout from '@/layouts/DefaultLayout.vue';
import { Head as HtmlHead } from '@inertiajs/vue3';
import { useLocales } from '@/handlers/locales';
import PageHeader from '@/components/ui/PageHeader.vue';
import PrimevueCard from 'primevue/card';
import UserForm from '@/components/users/forms/UserForm.vue';

defineOptions({
    layout: DefaultLayout,
});

defineProps({
    form: {
        type: Object,
        required: true,
    },
});

const { i18n } = useLocales();
</script>
