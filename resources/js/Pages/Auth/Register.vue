<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { trans as i18n, getActiveLanguage } from 'laravel-vue-i18n';

defineProps({
    allowLogin: {
        type: Boolean,
    },
    allowSecondaryCredential: {
        type: Boolean,
    },
    allowUsernameLogin: {
        type: Boolean,
    },
});

const form = useForm({
    name: '',
    email: '',
    username: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.transform((data) => ({
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

                <TextInput autocomplete="name" class="mt-1 block w-full placeholder:text-slate-400" id="name" type="text" autofocus required
                    :placeholder="i18n('Required')"
                    v-model="form.name" />

                <InputError class="mt-2" :message="i18n(form.errors.name)" v-if="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email"
                    :value="allowSecondaryCredential ? i18n('Primary Email') : i18n('Email')" />

                <TextInput autocomplete="email" class="mt-1 block w-full placeholder:text-slate-400" id="email" type="email" required
                    :placeholder="i18n('Required')"
                    v-model="form.email" />

                <InputError class="mt-2" :message="form.errors.email" v-if="form.errors.email" />
            </div>

            <div class="mt-4" v-if="allowSecondaryCredential">
                <InputLabel for="username"
                    :value="allowUsernameLogin ? i18n('Secondary Email or Username') : i18n('Secondary Email')" />

                <TextInput autocomplete="username" class="mt-1 block w-full placeholder:text-slate-400" id="username"
                    :type="allowUsernameLogin ? 'text' : 'email'"
                    :placeholder="i18n('Optional')"
                    v-model="form.username" />

                <InputError class="mt-2" :message="form.errors.username" v-if="form.errors.username" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" :value="i18n('Password')" />

                <TextInput autocomplete="new-password" class="mt-1 block w-full placeholder:text-slate-400" id="password" type="password" required
                    :placeholder="i18n('Required')"
                    v-model="form.password" />

                <InputError class="mt-2" :message="form.errors.password" v-if="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation"
                    :value="i18n('Confirm Password')"/>

                <TextInput autocomplete="new-password" class="mt-1 block w-full placeholder:text-slate-400" id="password_confirmation" type="password" required
                    :placeholder="i18n('Required')"
                    v-model="form.password_confirmation" />

                <InputError class="mt-2" :message="form.errors.password_confirmation" v-if="form.errors.password_confirmation" />
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
                    {{ i18n('Register') }}
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
