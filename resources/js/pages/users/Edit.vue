<template>
    <main class="content main">
        <page-header back-button fixed :actions="actions" :title="title" />

        <section class="section card mx-auto max-w-7xl">
            <div class="grid grid-cols-1 lg:grid-cols-5">

                <div class="utitilies order-2 lg:order-1 lg:col-span-2 p-3">
                    <div class="avatar utility mb-6">
                        <primevue-card class="mx-auto max-w-7xl space-y-6">
                            <template #title>
                                {{ i18n('Update Avatar') }}
                            </template>
                            <template #content>
                                <avatar-form
                                    :is-my-profile="isMyProfile"
                                    :model="user" />
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
                                    :is-my-profile="isMyProfile"
                                    :user="user" />
                            </template>
                        </primevue-card>
                    </div>
                    -->
                </div>

                <div class="forms order-1 lg:order-2 lg:col-span-3 p-3">
                    <user-form custom-actions updating ref="form"
                        :success="success"
                        :template="template" />
                </div>

            </div>
        </section>

        <footer class="footer">
            <form-actions v-if="ready"
                :form="form.$refs.userForm"
                :template="template" />
        </footer>
    </main>
</template>

<script setup>
import DefaultLayout from '@/layouts/DefaultLayout.vue';
import { Head as HtmlHead } from '@inertiajs/vue3';
import { computed, inject, onMounted, ref } from 'vue';
import { useLocales } from '@/handlers/locales';
import AvatarForm from '@/components/ui/avatars/AvatarForm.vue';
import FormActions from '@/components/forms/VueFormActions.vue';
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
    //allowSelfDelete: {
    //    type: Boolean,
    //    default: false,
    //},
    isMyProfile: {
        type: Boolean,
        default: false,
    },
    template: {
        type: Object,
        required: true,
    },
    user: {
        type: Object,
    },
});

const { i18n } = useLocales();

const { meta } = inject('app');

const form = ref();

const success = computed(() => props.isMyProfile
    ? 'Your account details have been updated.'
    : 'The user details have been updated.');

const title = computed(() => props.isMyProfile
    ? 'Edit My Profile'
    : `Edit ${props.user.name}`);

const ready = ref(false);

onMounted(() => {
    ready.value = true;
});
</script>
