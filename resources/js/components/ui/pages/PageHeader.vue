<template>
    <header class="header"
        :class="{ fixed }">
        <Head :title="i18n(title)"/>
        <h1>{{ i18n(heading || title) }}</h1>
        <page-actions :actions="actions" :back-button="backButton"/>
    </header>
</template>

<script>
import { Head } from '@inertiajs/vue3';
import PageActions from '@/components/ui/pages/PageActions.vue';

export default {
    components: {
        Head,
        PageActions,
    },

    inject: ['i18n'],

    props: {
        actions: {
            type: Array,
            default: [],
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
    },
};
</script>
