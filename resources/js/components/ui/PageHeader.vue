<template>
    <header class="header" :class="{ fixed }">
        <html-head :title="title" />
        <h1>{{ i18n(heading || title) }}</h1>
        <!--<page-actions :actions="actions" :back-button="backButton"/>-->
    </header>
</template>

<script setup>
import { Head as HtmlHead } from '@inertiajs/vue3';
import { inject } from 'vue';

const { backButton, fixed, heading, title } = defineProps({
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
