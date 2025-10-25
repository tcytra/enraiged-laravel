<template>  
    <header class="header" :class="{ fixed }">
        <html-head :title="i18n(title)" />
        <h1>{{ i18n(heading || title) }}</h1>
        <page-actions :actions="actions" :back-button="backButton"/>
    </header>
</template>

<script setup>
import { Head as HtmlHead } from '@inertiajs/vue3';
import { inject } from 'vue';
import PageActions from '@/components/ui/PageActions.vue';

defineProps({
    actions: {
        type: Object,
        default: null,
    },
    backButton: {
        type: Boolean,
        default: false,
    },
    fixed: {
        type: Boolean,
        default: false,
    },
    heading: {
        type: String,
        default: null,
    },
    title: {
        type: String,
        required: true,
    },
});

const { i18n } = inject('intl');
</script>
