<template>
    <div class="card container">
        <html-head :title="i18n('Confirm Password')" />

        <div id="teleport" class="flex-centered">
            <div class="mask"></div>
            <primevue-card class="md:w-md w-sm">
                <template #header>
                    <h1 class="text-lg">{{ i18n('Confirm Password') }}</h1>
                </template>
                <template #content>
                    <div class="mb-4 text-neutral text-sm">
                        {{ i18n('This is a secure area of the application. '
                            + 'Please confirm your password before continuing.') }}
                    </div>
                    <br>

                    <form class="form" @submit.prevent="submit">
                        <password-field autocomplete="new-password" id="password" umask
                            :field="{
                                label: 'Password',
                                placeholder: 'Required',
                            }"
                            :form="form" />

                        <div class="mt-4 flex flex-row-reverse items-center justify-start">
                            <primary-button class="ms-4"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                                @click="submit()">
                                {{ i18n('Confirm') }}
                            </primary-button>
                        </div>
                    </form>
                </template>
            </primevue-card>
        </div>

    </div>
</template>

<script setup>
import { Head as HtmlHead, useForm } from '@inertiajs/vue3';
import { useLocales } from '@/handlers/locales';
import PasswordField from '@/components/forms/fields/PasswordField.vue';
import PrimaryButton from '@/components/ui/buttons/PrimaryButton.vue';
import PrimevueCard from 'primevue/card';

const { i18n } = useLocales();

const form = useForm({
    password: null,
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    });
};
</script>
