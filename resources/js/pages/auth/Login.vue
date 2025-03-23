<script setup>
import Checkbox from '@/components/forms/fields/Checkbox.vue';
import GuestLayout from '@/layouts/GuestLayout.vue';
import InputError from '@/components/forms/fields/InputError.vue';
import InputLabel from '@/components/forms/fields/InputLabel.vue';
import PrimaryButton from '@/components/ui/buttons/PrimaryButton.vue';
import TextInput from '@/components/forms/fields/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { trans as i18n } from 'laravel-vue-i18n';

defineProps({
    allowUsernameLogin: {
        type: Boolean,
    },
    allowRegistration: {
        type: Boolean,
    },
    allowPasswordReset: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head :title="i18n('Login')" />

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" :value="allowUsernameLogin ? i18n('Email or Username') : i18n('Email')" />

                <TextInput autofocus required
                    id="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    :type="allowUsernameLogin ? 'text' : 'email'"
                    autocomplete="username"/>

                <InputError class="mt-2" :message="i18n(form.errors.email)" v-if="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" :value="i18n('Password')" />

                <TextInput required
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    autocomplete="current-password"/>

                <InputError class="mt-2" :message="form.errors.password" v-if="form.errors.password" />
            </div>

            <div class="mt-4 block">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ms-2 text-sm text-gray-600">
                        {{ i18n('Remember me') }}
                    </span>
                </label>
            </div>

            <div class="mt-4 flex items-center justify-end">
                <Link
                    v-if="allowRegistration"
                    :href="route('register')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    {{ i18n('Register') }}
                </Link>

                <span class="px-2" v-if="allowRegistration && allowPasswordReset">
                    &bull;
                </span>

                <Link
                    v-if="allowPasswordReset"
                    :href="route('password.request')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    {{ i18n('Reset Password') }}
                </Link>

                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                    {{ i18n('Login') }}
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
