<template>
    <main class="content main">
        <page-header back-button fixed :actions="actions" :title="title" />

        <section class="section card mx-auto max-w-7xl">
            <div class="grid grid-cols-1 md:grid-cols-5">

                <div class="utitilies md:col-span-2 p-3">
                    <div class="avatar utility mb-6">
                        <primevue-card class="mx-auto max-w-7xl space-y-6">
                            <template #title>
                                {{ i18n('Update Avatar') }}
                            </template>
                            <template #content>
                                <avatar-form
                                    :alert="alert"
                                    :errors="errors"
                                    :is-my-profile="isMyProfile"
                                    :user="user" />
                            </template>
                        </primevue-card>
                    </div>
                    <!--
                    <div class="theme utility mb-6">
                        <primevue-card class="mx-auto max-w-7xl space-y-6">
                            <template #title>
                                {{ i18n('Update Theme') }}
                            </template>
                            <template #content>
                                <update-theme-form
                                    :alert="alert"
                                    :errors="errors"
                                    :is-my-profile="isMyProfile"
                                    :user="user" />
                            </template>
                        </primevue-card>
                    </div>
                    -->
                    <div class="locale utility mb-6">
                        <primevue-card class="mx-auto max-w-7xl space-y-6">
                            <template #title>
                                {{ i18n('Update Locale') }}
                            </template>
                            <template #content>
                                <locale-form
                                    :alert="alert"
                                    :errors="errors"
                                    :is-my-profile="isMyProfile"
                                    :user="user" />
                            </template>
                        </primevue-card>
                    </div>
                    <!--
                    <div class="delete utility mb-6">
                        <primevue-card class="">
                            <template #title>
                                {{ i18n('Delete Account') }}
                            </template>
                            <template #content>
                                <delete-form
                                    :alert="alert"
                                    :errors="errors"
                                    :is-my-profile="isMyProfile"
                                    :user="user" />
                            </template>
                        </primevue-card>
                    </div>
                    -->
                </div>

                <div class="forms md:col-span-3 p-3">
                    <div class="details form mb-6">
                        <primevue-card class="mx-auto max-w-7xl space-y-6">
                            <template #title>
                                {{ i18n('Update Profile') }}
                            </template>
                            <template #content>
                                <information-form
                                    :alert="alert"
                                    :allow-secondary-credential="allowSecondaryCredential"
                                    :allow-username-login="allowUsernameLogin"
                                    :errors="errors"
                                    :is-my-profile="isMyProfile"
                                    :is-protected-user="isProtectedUser"
                                    :must-verify-email="mustVerifyEmail"
                                    :must-verify-secondary="mustVerifySecondary"
                                    :secondary-verification-link-sent="secondaryVerificationLinkSent"
                                    :user="user"
                                    :verification-link-sent="verificationLinkSent" />
                            </template>
                        </primevue-card>
                    </div>
                    <div class="password form mb-6">
                        <primevue-card class="mx-auto max-w-7xl space-y-6">
                            <template #title>
                                {{ i18n('Update Password') }}
                            </template>
                            <template #content>
                                <password-form
                                    :alert="alert"
                                    :errors="errors"
                                    :is-my-profile="isMyProfile"
                                    :user="user" />
                            </template>
                        </primevue-card>
                    </div>
                </div>

            </div>
        </section>

    </main>
</template>

<script setup>
import { Head as HtmlHead } from '@inertiajs/vue3';
import { computed, onMounted } from 'vue';
import { useLocales } from '@/handlers/locales';
import AvatarForm from '@/components/ui/avatars/AvatarForm.vue';
//import DeleteForm from '@/components/users/forms/DeleteForm.vue';
import InformationForm from '@/components/users/forms/InformationForm.vue';
import LocaleForm from '@/components/users/forms/LocaleForm.vue';
import PageHeader from '@/components/ui/PageHeader.vue';
import PasswordForm from '@/components/users/forms/PasswordForm.vue';
import PrimevueCard from 'primevue/card';
import ThemeForm from '@/components/users/forms/ThemeForm.vue';

const props = defineProps({
    actions: {
        type: Object,
        default: {},
    },
    alert: {
        type: String,
        default: null,
    },
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
    errors: {
        type: Object,
        default: null,
    },
    isMyProfile: {
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
    secondaryVerificationLinkSent: {
        type: Boolean,
        default: false,
    },
    user: {
        type: Object,
    },
    verificationLinkSent: {
        type: Boolean,
        default: false,
    },
});

const { i18n } = useLocales();

const title = computed(() => props.isMyProfile ? 'Edit My Profile' : `Edit ${props.user.name}`);
</script>
