<script setup>
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { trans as i18n } from 'laravel-vue-i18n';

defineProps({
    appName: {
        type: String,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Head :title="i18n('Dashboard')" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ i18n('Dashboard') }}
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <span>{{ i18n('Welcome to :app!').replace(':app', appName) }}</span>
                        <span class="px-1" v-show="status === 'email-verification-success'">
                            {{ i18n('Your email address has been verified!') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
