<template>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ i18n('Update Password') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ i18n('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>
    <form class="form mt-6 max-w-xl" @submit.prevent="submit">
        <password-field id="current_password"
            :field="{
                label: 'Current Password',
                placeholder: 'Required',
                type: 'password',
            }"
            :form="form" />
        <password-field id="password"
            :field="{
                label: 'New Password',
                placeholder: 'Required',
                type: 'password',
            }"
            :form="form" />
        <password-field id="password_confirmation"
            :field="{
                label: 'Confirm Password',
                placeholder: 'Required',
                type: 'password',
            }"
            :form="form" />

        <div class="flex flex-row-reverse items-center gap-4 mt-6">
            <primary-button :disabled="form.processing" @click="submit()">
                {{ i18n('Save') }}
            </primary-button>

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
import { loadLanguageAsync as ai18n } from 'laravel-vue-i18n';
import PasswordField from '@/components/forms/fields/PasswordField.vue';
import PrimaryButton from '@/components/ui/buttons/PrimaryButton.vue';
import SecondaryButton from '@/components/ui/buttons/SecondaryButton.vue';

defineProps({
    status: {
        type: String,
    },
});

const { auth } = inject('app');
const { i18n } = inject('intl');

const form = useForm({
    current_password: null,
    password: null,
    password_confirmation: null,
});

const submit = () => {
    form.put(route('users.password.update', {user: auth.id}), {
        onSuccess: () => form.reset(),
    });
};
</script>
