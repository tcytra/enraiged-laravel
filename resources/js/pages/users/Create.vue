<template>
    <main class="content main">
        <page-header back-button fixed title="Create User" />

        <section class="section form mx-auto max-w-7xl">
            ...
        </section>

        <pre>{{ form }}</pre>
    </main>
</template>

<script setup>
import { Head as HtmlHead } from '@inertiajs/vue3';
import { useLocales } from '@/handlers/locales';
import PageHeader from '@/components/ui/PageHeader.vue';

defineProps({
    form: {
        type: Object,
        required: true,
    },
});

const { i18n } = useLocales();
</script>
