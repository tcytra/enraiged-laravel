<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { trans as i18n, getActiveLanguage } from 'laravel-vue-i18n';

defineProps({
    canLogin: {
        type: Boolean,
    },
});

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.locale = getActiveLanguage();
    form
        .transform((data) => ({
            ...data,
            locale: getActiveLanguage(),
        }))
        .post(route('register'), {
            onFinish: () => form.reset('password', 'password_confirmation'),
        });
};
</script>

<template>
    <GuestLayout>
        <Head :title="i18n('Register')" />

        <form @submit.prevent="submit">
            <input type="hidden" v-model="form.locale" />
            <div>
                <InputLabel for="name" :value="i18n('Full Name')" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name" />

                <InputError class="mt-2" :message="i18n(form.errors.name)" v-if="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" :value="i18n('Email')" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username" />

                <InputError class="mt-2" :message="form.errors.email" v-if="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" :value="i18n('Password')" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password" />

                <InputError class="mt-2" :message="form.errors.password" v-if="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="password_confirmation"
                    :value="i18n('Confirm Password')"/>

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password" />

                <InputError class="mt-2" :message="form.errors.password_confirmation" v-if="form.errors.password_confirmation" />
            </div>

            <div class="mt-4 flex items-center justify-end">
                <Link
                    v-if="canLogin"
                    :href="route('login')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    {{ i18n('Login') }}
                </Link>

                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                    {{ i18n('Register') }}
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
