<template>
    <header class="header">
        <Head :title="title"/>
        <h1>{{ header || title }}</h1>
        <page-actions :actions="actions"/>
    </header>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';
import PageActions from '@/components/ui/pages/PageActions.vue';

export default {
    components: {
        Head,
        PageActions,
    },

    props: {
        actions: {
            type: Object,
        },
        backButton: {
            type: Boolean,
            default: false,
        },
        header: {
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
