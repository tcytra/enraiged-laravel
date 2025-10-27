<template>
    <div>
        <html-head :title="i18n('Login')" />

        <primevue-card class="md:w-md w-sm">
            <template #header>
                <h1 class="text-lg">{{ i18n('Login') }}</h1>
            </template>
            <template #content>
                <div v-if="status" class="mb-4 text-sm font-medium">
                    {{ status }}
                </div>
                <form class="form" @submit.prevent="submit">
                    <text-field autofocus autocomplete="email" id="email"
                        :field="{
                            label: allowUsernameLogin ? 'Email or Username' : 'Email',
                            type: allowUsernameLogin ? 'text' : 'email',
                        }"
                        :form="form" />
                    <password-field autocomplete="current-password" id="password"
                        :field="{
                            label: 'Password',
                            type: 'password',
                        }"
                        :form="form" />
                    <checkbox-field class="horizontal checkbox-first" id="remember"
                        :field="{
                            label: 'Remember me',
                            type: 'checkbox',
                        }"
                        :form="form" />

                    <div class="mt-4 flex flex-row-reverse items-center justify-start">
                        <primary-button class="ms-4"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                            @click="submit()">
                            {{ i18n('Login') }}
                        </primary-button>
                        <html-link class="text-link text-sm"
                            v-if="allowPasswordReset"
                            :href="route('password.request')">
                            {{ i18n('Forgot Password') }}
                        </html-link>
                        <span class="px-2" v-if="allowRegistration && allowPasswordReset">
                            &bull;
                        </span>
                        <html-link class="text-link text-sm"
                            v-if="allowRegistration"
                            :href="route('register')">
                            {{ i18n('Register') }}
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
import { useLocales } from '@/handlers/locales';
import CheckboxField from '@/components/forms/fields/CheckboxField.vue';
import PasswordField from '@/components/forms/fields/PasswordField.vue';
import PrimaryButton from '@/components/ui/buttons/PrimaryButton.vue';
import PrimevueCard from 'primevue/card';
import TextField from '@/components/forms/fields/TextField.vue';

const props = defineProps({
    allowUsernameLogin: {
        type: Boolean,
        default: false,
    },
    allowRegistration: {
        type: Boolean,
        default: false,
    },
    allowPasswordReset: {
        type: Boolean,
        default: true,
    },
    status: {
        type: String,
        default: null,
    },
});

const form = useForm({
    email: null,
    password: null,
    remember: false,
});

const { i18n } = useLocales();

const { state } = inject('app');

const route = inject('route');

const submit = () => {
    form.post(route('login'), {
        onFinish: () => {
            form.reset('password');
            state();
        },
    });
};
</script>
