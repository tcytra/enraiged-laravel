<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { trans as i18n, loadLanguageAsync as ai18n,  } from 'laravel-vue-i18n';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const resolver = lang => import(`./fixtures/lang/${lang}.json`);

const locales = [
    {locale: 'en', name: 'English'},
    {locale: 'es', name: 'Spanish'},
    {locale: 'fr', name: 'French'},
];

const user = usePage().props.auth.user;

const form = useForm({
    email: user.email,
    locale: user.locale,
    name: user.name,
});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ i18n('Profile Information') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ i18n('Update your account\'s profile information and email address.') }}
            </p>
        </header>

        <form class="mt-6 space-y-6"
            @submit.prevent="form.patch(route('users.update', {user: user.id}))">
            <div>
                <InputLabel for="name" :value="i18n('Name')" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    :placeholder="i18n('Required')"
                    required
                    autofocus
                    autocomplete="name" />

                <InputError class="mt-2" :message="i18n(form.errors.name)" v-if="form.errors.name" />
            </div>

            <div>
                <InputLabel for="email" :value="i18n('Email')" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    :placeholder="i18n('Required')"
                    required
                    autocomplete="username" />

                <InputError class="mt-2" :message="i18n(form.errors.email)" v-if="form.errors.email" />
            </div>

            <div>
                <input type="hidden" v-model="form.locale" />
                <InputLabel for="locale" :value="i18n('Language')" />

                <div class="flex justify-between">
                    <SecondaryButton class="px-12" v-for="{locale, name} in locales"
                        :disabled="form.processing || form.locale === locale"
                        :key="locale"
                        @click="form.locale = locale; ai18n(locale)">
                        {{ i18n(name) }}
                    </SecondaryButton>
                </div>
            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="mt-2 text-sm text-gray-800">
                    {{ i18n('Your email address is unverified.') }}
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        {{ i18n('Click here to re-send the verification email.') }}
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 text-sm font-medium text-green-600">
                    {{ i18n('A new verification link has been sent to your email address.') }}
                </div>
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">
                    {{ i18n('Save') }}
                </PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0">
                    <p class="text-sm text-gray-600"
                        v-if="form.recentlySuccessful">
                        {{ i18n('Success') }}
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
