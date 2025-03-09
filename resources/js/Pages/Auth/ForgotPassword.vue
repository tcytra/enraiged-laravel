<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { trans as i18n } from 'laravel-vue-i18n';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>
        <Head :title="i18n('Forgot Password')" />

        <div class="mb-4 text-sm text-gray-600">
            {{ i18n('Provide your email address and follow the instructions sent to your inbox to reset the password.') }}
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
                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                    {{ i18n('Send Reset Link') }}
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
