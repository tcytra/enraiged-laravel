<script setup>
import GuestLayout from '@/layouts/GuestLayout.vue';
import InputError from '@/components/forms/fields/InputError.vue';
import InputLabel from '@/components/forms/fields/InputLabel.vue';
import PrimaryButton from '@/components/ui/buttons/PrimaryButton.vue';
import TextInput from '@/components/forms/fields/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { trans as i18n, getActiveLanguage } from 'laravel-vue-i18n';

defineProps({
    allowLogin: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.transform((data) => ({
            ...data,
            locale: getActiveLanguage(),
        }))
        .post(route('password.email'));
};
</script>

<template>
    <GuestLayout>
        <Head :title="i18n('Forgot Password')" />

        <div class="mb-4 text-sm text-gray-600">
            {{ i18n('Provide your email address and follow the instructions sent to your inbox to reset your password.') }}
        </div>

        <div class="mb-4 text-sm font-medium text-green-600" v-if="status">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" :value="i18n('Email')" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"/>

                <InputError class="mt-2" :message="i18n(form.errors.email)" v-if="form.errors.email" />
            </div>

            <div class="mt-4 flex items-center justify-end">
                <Link class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    v-if="allowLogin"
                    :href="route('login')">
                    {{ i18n('Login') }}
                </Link>

                <PrimaryButton class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                    {{ i18n('Send Reset Link') }}
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
