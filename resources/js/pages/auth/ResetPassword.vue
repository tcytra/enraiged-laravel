<template>
    <div>
        <html-head :title="i18n('Reset Password')" />

        <primevue-card class="w-xs">
            <template #header>
                <h1 class="text-lg">{{ i18n('Reset Password') }}</h1>
            </template>
            <template #content>
                <form class="form" @submit.prevent="submit">
                    <text-field autocomplete="email" id="email" disabled
                        :field="{
                            label: 'Email',
                            type: 'email',
                        }"
                        :form="form" />
                    <password-field autocomplete="new-password" id="password" umask
                        :field="{
                            label: 'Password',
                            placeholder: 'Required',
                        }"
                        :form="form" />
                    <password-field autocomplete="new-password" id="password_confirmation" feedback
                        :field="{
                            label: 'Confirm Password',
                            placeholder: 'Required',
                        }"
                        :form="form" />

                    <div class="mt-4 flex flex-row-reverse items-center justify-start">
                        <primary-button
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                            @click="submit()">
                            {{ i18n('Reset Password') }}
                        </primary-button>
                    </div>
                </form>
            </template>
        </primevue-card>
    </div>
</template>

<script setup>
import DefaultLayout from '@/layouts/DefaultLayout.vue';
import { Head as HtmlHead, useForm } from '@inertiajs/vue3';
import { useLocales } from '@/handlers/locales';
import PasswordField from '@/components/forms/fields/PasswordField.vue';
import PrimaryButton from '@/components/ui/buttons/PrimaryButton.vue';
import PrimevueCard from 'primevue/card';
import TextField from '@/components/forms/fields/TextField.vue';

defineOptions({
    layout: DefaultLayout,
});

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
});

const { i18n } = useLocales();

const form = useForm({
    token: props.token,
    email: props.email,
    password: null,
    password_confirmation: null,
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>
