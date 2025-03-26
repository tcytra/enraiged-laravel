<script setup>
import InputError from '@/components/forms/fields/InputError.vue';
import InputLabel from '@/components/forms/fields/InputLabel.vue';
import InputWarning from '@/components/forms/fields/InputWarning.vue';
import PrimaryButton from '@/components/ui/buttons/PrimaryButton.vue';
import SecondaryButton from '@/components/ui/buttons/SecondaryButton.vue';
import TextInput from '@/components/forms/fields/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { trans as i18n, loadLanguageAsync as ai18n,  } from 'laravel-vue-i18n';

defineProps({
    allowSecondaryCredential: {
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
    username: user.username,
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
            <p>{{ form.isDirty }}</p>
            <div>
                <InputLabel for="name" :value="i18n('Name')" />

                <TextInput autocomplete="name" class="mt-1 block placeholder:text-slate-400 w-full" id="name" type="text" autofocus required
                    v-model="form.name"
                    :placeholder="i18n('Required')" />

                <InputError class="mt-2" :message="i18n(form.errors.name)" v-if="form.errors.name" />
            </div>

            <div>
                <InputLabel for="email" :value="i18n('Email')" />

                <TextInput autocomplete="email" class="mt-1 block placeholder:text-slate-400 w-full" id="email" type="email" required
                    :class="{'bg-amber-100': mustVerifyEmail}"
                    :disabled="isProtectedUser || (form.isDirty && form.username !== user.username)"
                    v-model="form.email"
                    :placeholder="i18n('Required')" />

                <InputWarning class="mt-2" :message="i18n('Your email address is unverified.')" v-if="mustVerifyEmail" />
                <InputError class="mt-2" :message="i18n(form.errors.email)" v-else-if="form.errors.email" />

                <div v-if="mustVerifyEmail">
                    <p class="mt-2 text-sm text-gray-800">
                        <Link as="button" method="post"
                            :href="route('verification.send')"
                            class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            {{ i18n('Click here to re-send the verification email.') }}
                        </Link>
                    </p>

                    <div class="mt-2 text-sm font-medium text-green-600"
                        v-show="status === 'verification-link-sent'">
                        {{ i18n('A new verification link has been sent to your email address.') }}
                    </div>
                </div>
            </div>

            <div v-if="allowSecondaryCredential">
                <InputLabel for="username"
                    :value="allowUsernameLogin ? i18n('Secondary Email or Username') : i18n('Secondary Email')" />

                <TextInput autocomplete="username" class="mt-1 block w-full placeholder:text-slate-400" id="username"
                    :class="{'bg-amber-100': mustVerifySecondary}"
                    :disabled="form.isDirty && form.email !== user.email"
                    :type="allowUsernameLogin ? 'text' : 'email'"
                    :placeholder="i18n('Optional')"
                    v-model="form.username" />

                <InputWarning class="mt-2" :message="i18n('Your secondary email address is unverified.')" v-if="mustVerifySecondary" />
                <InputError class="mt-2" :message="form.errors.username" v-else-if="form.errors.username" />

                <div v-if="mustVerifySecondary">
                    <p class="mt-2 text-sm text-gray-800">
                        <Link as="button" method="post"
                            :href="route('secondary.verification.send')"
                            class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            {{ i18n('Click here to re-send the verification email.') }}
                        </Link>
                    </p>

                    <div class="mt-2 text-sm font-medium text-green-600"
                        v-show="status === 'secondary-verification-link-sent'">
                        {{ i18n('A verification link has been sent to your secondary email address.') }}
                    </div>
                </div>
                <div class="mt-2 text-sm font-medium text-green-600"
                    v-show="status === 'secondary-verification-success'">
                    {{ i18n('Your secondary email address has been verified.') }}
                </div>
            </div>

            <div>
                <input type="hidden" v-model="form.locale" />
                <InputLabel class="pb-1" for="locale" :value="i18n('Language')" />

                <div class="flex justify-between">
                    <SecondaryButton class="!px-12" v-for="{locale, name} in locales"
                        :disabled="form.processing || form.locale === locale"
                        :key="locale"
                        @click="form.locale = locale; ai18n(locale)">
                        {{ i18n(name) }}
                    </SecondaryButton>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">
                    {{ i18n('Save') }}
                </PrimaryButton>

                <SecondaryButton :disabled="form.processing || !form.isDirty" @click="form.reset()">
                    {{ i18n('Reset') }}
                </SecondaryButton>

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
