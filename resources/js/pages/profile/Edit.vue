<template>
    <div class="container page">
        <html-head :title="i18n('My Profile')" />

        <header>
            <div class="mx-auto max-w-7xl py-6">
                <h2 class="text-xl font-semibold leading-tight">
                    {{ i18n('My Profile') }}
                </h2>
            </div>
        </header>

        <profile-card class="mb-6">
            <template #content>
                <div class="flex flex-col lg:flex-row">
                    <div class="w-full lg:w-1/2 mb-6 lg:mr-6">
                        <update-information-form
                            :allow-secondary-credential="allowSecondaryCredential"
                            :allow-username-login="allowUsernameLogin"
                            :is-protected-user="isProtectedUser"
                            :must-verify-email="mustVerifyEmail"
                            :must-verify-secondary="mustVerifySecondary"
                            :status="status" />
                    </div>
                    <div class="w-full lg:w-1/2 mb-6 lg:ml-6">
                        <update-password-form
                            :status="status" />
                    </div>
                </div>
            </template>
        </profile-card>

        <profile-card class="mb-6">
            <template #content>
                <delete-form
                    :status="status" />
            </template>
        </profile-card>
    </div>
</template>

<script setup>
import { Head as HtmlHead } from '@inertiajs/vue3';
import { trans as i18n } from 'laravel-vue-i18n';
import DefaultLayout from '@/layouts/DefaultLayout.vue';
import ProfileCard from '@/components/users/cards/ProfileCard.vue';
import UpdateInformationForm from '@/components/users/forms/UpdateInformationForm.vue';
import UpdatePasswordForm from '@/components/users/forms/UpdatePasswordForm.vue';
import DeleteForm from '@/components/users/forms/DeleteForm.vue';

defineOptions({
    layout: DefaultLayout,
});

const props = defineProps({
    allowSecondaryCredential: {
        type: Boolean,
        default: false,
    },
    allowSelfDelete: {
        type: Boolean,
        default: false,
    },
    allowUsernameLogin: {
        type: Boolean,
        default: false,
    },
    isProtectedUser: {
        type: Boolean,
        default: false,
    },
    mustVerifyEmail: {
        type: Boolean,
        default: false,
    },
    mustVerifySecondary: {
        type: Boolean,
        default: false,
    },
    status: {
        type: String,
        default: null,
    },
});
</script>
