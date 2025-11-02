<template>
    <div>
        <html-head :title="i18n('Forgot Password')" />

        <primevue-card class="w-xs">
            <template #header>
                <h1 class="text-lg">{{ i18n('Forgot Password') }}</h1>
            </template>
            <template #content>
                <div class="mb-4 text-sm font-medium text-green-600" v-if="message">
                    {{ message }}
                </div>
                <div class="mb-4 text-sm text-gray-400" v-else>
                    {{ i18n('Provide your email address and follow the instructions '
                        + 'sent to your inbox to reset your password.') }}
                </div>
                <form class="form" @submit.prevent="submit">
                    <text-field autofocus autocomplete="email" id="email"
                        :field="{
                            label: 'Email',
                            placeholder: 'Required',
                            type: 'email',
                        }"
                        :form="form" />

                    <div class="mt-4 flex flex-row-reverse items-center justify-start">
                        <primary-button class="ms-4"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                            @click="submit()">
                            {{ i18n('Send Reset Link') }}
                        </primary-button>
                        <html-link class="text-link text-sm"
                            v-if="allowLogin"
                            :href="route('login')">
                            {{ i18n('Login') }}
                        </html-link>
                    </div>
                </form>
            </template>
        </primevue-card>
    </div>
</template>

<script setup>
import { Head as HtmlHead, Link as HtmlLink, useForm } from '@inertiajs/vue3';
import { useLocales } from '@/handlers/locales';
import PrimaryButton from '@/components/ui/buttons/PrimaryButton.vue';
import PrimevueCard from 'primevue/card';
import TextField from '@/components/forms/fields/TextField.vue';

defineProps({
    allowLogin: {
        type: Boolean,
    },
    message: {
        type: String,
    },
});

const { i18n, lang } = useLocales();

const form = useForm({
    email: null,
});

const submit = () => {
    form.transform((data) => ({
            ...data,
            locale: lang(),
        }))
        .post(route('password.email'));
};
</script>
