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
                    <user-form updating
                        :success="success"
                        :template="form" />
                </div>

            </div>
        </section>

    </main>
</template>

<script setup>
import DefaultLayout from '@/layouts/DefaultLayout.vue';
import { Head as HtmlHead } from '@inertiajs/vue3';
import { computed, inject } from 'vue';
import { useLocales } from '@/handlers/locales';
import AvatarForm from '@/components/ui/avatars/AvatarForm.vue';
import LocaleForm from '@/components/users/forms/LocaleForm.vue';
import PageHeader from '@/components/ui/PageHeader.vue';
import PrimevueCard from 'primevue/card';
import UserForm from '@/components/users/forms/UserForm.vue';
//import ThemeForm from '@/components/users/forms/ThemeForm.vue';

defineOptions({
    layout: DefaultLayout,
});

const props = defineProps({
    actions: {
        type: Object,
        default: {},
    },
    alert: {
        type: String,
        default: null,
    },
    //allowSelfDelete: {
    //    type: Boolean,
    //    default: false,
    //},
    errors: {
        type: Object,
        default: null,
    },
    form: {
        type: Object,
        required: true,
    },
    isMyProfile: {
        type: Boolean,
        default: false,
    },
    user: {
        type: Object,
    },
});

const { i18n } = useLocales();

const { meta } = inject('app');

const success = computed(() => props.isMyProfile
    ? 'Your account details have been updated.'
    : 'The user details have been updated.');

const title = computed(() => props.isMyProfile
    ? 'Edit My Profile'
    : `Edit ${props.user.name}`);
</script>
