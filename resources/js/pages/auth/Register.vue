<template>
    <div>
        <html-head :title="i18n('Register')" />

        <primevue-card class="md:w-sm w-xs">
            <template #header>
                <h1 class="text-lg">{{ i18n('Register') }}</h1>
            </template>
            <template #content>
                <form class="form" @submit.prevent="submit">
                    <input type="hidden" v-model="form.locale" />

                    <text-field autofocus autocomplete="name" id="name"
                        :field="{
                            label: 'Full Name',
                            placeholder: 'Required',
                            type: 'text',
                        }"
                        :form="form" />
                    <text-field autocomplete="email" id="email"
                        :field="{
                            label: allowSecondaryCredential ? 'Primary Email' : 'Email',
                            placeholder: 'Required',
                            type: 'email',
                        }"
                        :form="form" />
                    <text-field autocomplete="username" id="username" v-if="allowSecondaryCredential"
                        :field="{
                            label: allowUsernameLogin ? 'Secondary Email or Username' : 'Secondary Email',
                            placeholder: 'Optional',
                            type: allowUsernameLogin ? 'text' : 'email',
                        }"
                        :form="form" />
                    <password-field autocomplete="new-password" id="password" umask
                        :field="{
                            label: 'Password',
                            placeholder: 'Required',
                            type: 'password',
                        }"
                        :form="form" />
                    <password-field autocomplete="new-password" id="password_confirmation" feedback
                        :field="{
                            label: 'Confirm Password',
                            placeholder: 'Required',
                            type: 'password',
                        }"
                        :form="form" />
                    <checkbox-field class="horizontal checkbox-first" id="agreed"
                        :field="{
                            label: 'I agree to check the little box',
                            type: 'checkbox',
                        }"
                        :form="form" />

                    <div class="mt-4 flex flex-row-reverse items-center justify-start">
                        <primary-button class="ms-4"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                            @click="submit()">
                            {{ i18n('Register') }}
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
import { inject } from 'vue';
import { palette } from '@/themes/palette';
import { useLocales } from '@/handlers/locales';
import CheckboxField from '@/components/forms/fields/CheckboxField.vue';
import PasswordField from '@/components/forms/fields/PasswordField.vue';
import PrimaryButton from '@/components/ui/buttons/PrimaryButton.vue';
import PrimevueCard from 'primevue/card';
import TextField from '@/components/forms/fields/TextField.vue';

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

const {
    currentPrimary,
    currentSurface,
    enableDarkMode,
} = palette();

const { i18n, lang } = useLocales();

const { state } = inject('app');

const route = inject('route');

const form = useForm({
    agreed: false,
    name: null,
    email: null,
    username: null,
    password: null,
    password_confirmation: null,
});

const submit = () => {
    form.transform((data) => ({
            ...data,
            locale: lang(),
            theme: {
                mode: enableDarkMode.value === true ? 'dark' : 'light',
                primary: currentPrimary.value,
                surface: currentSurface.value,
            },
        }))
        .post(route('register'), {
            onFinish: () => {
                form.reset('password', 'password_confirmation');
                state();
            },
        });
};
</script>
