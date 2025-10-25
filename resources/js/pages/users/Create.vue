<template>
    <main class="content main">
        <page-header fixed title="Create User" />

        <section class="section card mx-auto max-w-7xl">
            ...
        </section>
    </main>
</template>

<script setup>
import { Head as HtmlHead } from '@inertiajs/vue3';
import { inject } from 'vue';
import PageHeader from '@/components/ui/PageHeader.vue';

const { i18n } = inject('intl');
</script>
