<template>
    <div class="container page">
        <html-head :title="i18n('Dashboard')" />

        <header>
            <div class="mx-auto max-w-7xl py-6">
                <h2 class="text-xl font-semibold leading-tight">
                    {{ i18n('Dashboard') }}
                </h2>
            </div>
        </header>

        <primevue-card class="mx-auto max-w-7xl">
            <template #content>
                <span>{{ i18n('Welcome to :app!').replace(':app', appName) }}</span>
                <span class="px-1 text-success" v-show="status === 'email-verification-success'">
                    {{ i18n('Your email address has been verified!') }}
                </span>
                <span class="px-1 text-success" v-show="status === 'secondary-verification-success'">
                    {{ i18n('Your secondary email address has been verified.') }}
                </span>
            </template>
        </primevue-card>
    </div>
</template>

<script setup>
import { Head as HtmlHead } from '@inertiajs/vue3';
import { inject } from 'vue';
import PrimevueCard from 'primevue/card';

defineProps({
    appName: {
        type: String,
    },
    status: {
        type: String,
    },
});

const { i18n } = inject('intl');
</script>
