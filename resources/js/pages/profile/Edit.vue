<template>
    <main class="content main">
        <page-header fixed title="My Profile" />

        <section class="section card">
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
        </section>

        <section class="section card">
            <profile-card class="mb-6">
                <template #content>
                    <delete-form
                        :status="status" />
                </template>
            </profile-card>
        </section>
    </main>
</template>

<script setup>
import { Head as HtmlHead } from '@inertiajs/vue3';
import { inject } from 'vue';
import PageHeader from '@/components/ui/PageHeader.vue';
import ProfileCard from '@/components/users/cards/ProfileCard.vue';
import UpdateInformationForm from '@/components/users/forms/UpdateInformationForm.vue';
import UpdatePasswordForm from '@/components/users/forms/UpdatePasswordForm.vue';
import DeleteForm from '@/components/users/forms/DeleteForm.vue';

defineProps({
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

const { i18n } = inject('intl');
</script>
