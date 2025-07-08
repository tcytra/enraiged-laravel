<template>
    <div class="flex min-h-screen items-center justify-center">
        <html-head :title="i18n('Loading')" />
        <application-logo class="h-20 w-20 fill-current text-gray-500" />
    </div>
</template>

<script setup>
import { trans as i18n } from 'laravel-vue-i18n';
import { Head as HtmlHead } from '@inertiajs/vue3';
import ApplicationLogo from '@/components/ui/ApplicationLogo.vue';
</script>
