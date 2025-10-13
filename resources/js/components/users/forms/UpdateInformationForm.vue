<template>
    <header>
        <h2 class="text-lg font-medium text-surface">
            {{ i18n('Profile Information') }}
        </h2>
        <p class="mt-1 text-sm text-neutral">
            {{ i18n('Update your account\'s profile information and email address.') }}
        </p>
    </header>
    <form class="form mt-6 max-w-xl" @submit.prevent="submit">
        <text-field class="mb-3" id="name"
            :field="{
                label: 'Full Name',
                placeholder: 'Required',
                type: 'text',
            }"
            :form="form" />

        <text-field id="email"
            :field="{
                label: allowSecondaryCredential ? 'Primary Email' : 'Email Address',
                placeholder: 'Required',
                type: 'email',
            }"
            :form="form" />

        <div v-if="mustVerifyEmail">
            <p class="mt-2 text-sm text-neutral">
                <html-link as="button" class="text-link" method="post" :href="route('verification.send')">
                    {{ i18n('Click here to re-send the verification email.') }}
                </html-link>
            </p>
            <div class="mt-2 text-sm text-success" v-show="status === 'verification-link-sent'">
                {{ i18n('A new verification link has been sent to your email address.') }}
            </div>
        </div>

        <text-field id="username" v-if="allowSecondaryCredential"
            :field="{
                label: allowUsernameLogin ? 'Secondary Email or Username' : 'Secondary Email',
                placeholder: 'Optional',
                type: allowUsernameLogin ? 'text' : 'email',
            }"
            :form="form" />

        <div v-if="mustVerifySecondary">
            <p class="mt-2 text-sm text-warning" v-show="!status">
                {{ i18n('This email address must be verified before it can be used to log in.') }}
            </p>
            <p class="mt-2 text-sm text-neutral" v-show="!status">
                <html-link as="button" class="text-link" method="post" :href="route('secondary.verification.send')">
                    {{ i18n('Click here to re-send the verification email.') }}
                </html-link>
            </p>
            <p class="mt-2 text-sm text-success" v-show="status === 'secondary-verification-link-sent'">
                {{ i18n('A verification link has been sent to your secondary email address.') }}
            </p>
        </div>

        <hidden-field id="locale"
            :field="{
                label: 'Language',
            }"
            :form="form">
            <template #content="field">
                <div class="control field">
                    <label class="block label">
                        {{ field.label }}
                    </label>
                    <div class="flex justify-between w-full">
                        <secondary-button class="!px-12" v-for="(name, locale) in locales"
                            :disabled="form.processing || form.locale === locale"
                            :key="locale"
                            @click="form.locale = locale; ai18n(locale)">
                            {{ name }}
                        </secondary-button>
                    </div>
                </div>
            </template>
        </hidden-field>

        <div class="flex flex-row-reverse items-center gap-4 mt-6">
            <primary-button :disabled="form.processing" @click="submit()">
                {{ i18n('Save') }}
            </primary-button>

            <secondary-button size="small" :disabled="form.processing || !form.isDirty" @click="form.reset()">
                {{ i18n('Reset') }}
            </secondary-button>

            <Transition
                enter-active-class="transition ease-in-out"
                enter-from-class="opacity-0"
                leave-active-class="transition ease-in-out"
                leave-to-class="opacity-0">
                <p class="text-sm text-success"
                    v-if="form.recentlySuccessful">
                    {{ i18n('Success') }}
                </p>
            </Transition>
        </div>
    </form>
</template>

<script setup>
import { Link as HtmlLink, useForm } from '@inertiajs/vue3';
import { inject } from 'vue';
import HiddenField from '@/components/forms/fields/HiddenField.vue';
import PrimaryButton from '@/components/ui/buttons/PrimaryButton.vue';
import SecondaryButton from '@/components/ui/buttons/SecondaryButton.vue';
import TextField from '@/components/forms/fields/TextField.vue';

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

const { auth, meta } = inject('app');
const { ai18n, i18n } = inject('intl');
const locales = meta.value.locales;
const user = auth.value;

const form = useForm({
    email: user.email,
    locale: user.locale,
    name: user.name,
    username: user.username,
});

const submit = () => {
    form.patch(route('users.update', {user: user.id}));
};
</script>
