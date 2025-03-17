<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { trans as i18n, getActiveLanguage } from 'laravel-vue-i18n';

const form = useForm({
    password: '',
});

const submit = () => {
    form.transform((data) => ({
            ...data,
            locale: getActiveLanguage(),
        }))
        .post(route('password.confirm'), {
            onFinish: () => form.reset(),
        });
};
</script>

<template>
    <GuestLayout>
        <Head :title="i18n('Confirm Password')" />

        <div class="mb-4 text-sm text-gray-600">
            {{ i18n('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="password" :value="i18n('Password')" />
                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                    autofocus />
                <InputError class="mt-2" :message="i18n(form.errors.password)" v-if="form.errors.password" />
            </div>

            <div class="mt-4 flex justify-end">
                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing">
                    {{ i18n('Confirm') }}
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
