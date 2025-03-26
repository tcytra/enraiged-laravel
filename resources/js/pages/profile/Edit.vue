<script setup>
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './partials/DeleteUserForm.vue';
import UpdatePasswordForm from './partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';
import { trans as i18n } from 'laravel-vue-i18n';

defineProps({
    allowSecondaryCredential: {
        type: Boolean,
    },
    allowSelfDelete: {
        type: Boolean,
    },
    allowUsernameLogin: {
        type: Boolean,
    },
    isProtectedUser: {
        type: Boolean,
    },
    mustVerifyEmail: {
        type: Boolean,
    },
    mustVerifySecondary: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Head :title="i18n('Profile')" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ i18n('Profile') }}
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <UpdateProfileInformationForm
                        :allow-secondary-credential="allowSecondaryCredential"
                        :allow-username-login="allowUsernameLogin"
                        :is-protected-user="isProtectedUser"
                        :must-verify-email="mustVerifyEmail"
                        :must-verify-secondary="mustVerifySecondary"
                        :status="status"
                        class="max-w-xl" />
                </div>

                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8" v-if="!isProtectedUser">
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8" v-if="allowSelfDelete && !isProtectedUser">
                    <DeleteUserForm class="max-w-xl" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
