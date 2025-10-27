<template>
    <header>
        <p class="text-neutral text-sm">
            {{ i18n('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>
    <form class="form" @submit.prevent="submit">
        <div class="grid grid-cols-1 lg:grid-cols-2 mt-5 gap-4">
            <password-field id="password"
                :field="{
                    label: 'New Password',
                    placeholder: 'Required',
                    type: 'password',
                }"
                :form="form" />
            <password-field id="password_confirmation"
                :field="{
                    label: 'Confirm Password',
                    placeholder: 'Required',
                    type: 'password',
                }"
                :form="form" />
        </div>

        <div class="flex flex-row-reverse items-center gap-4 mt-6">
            <primary-button :disabled="form.processing" @click="submit()">
                {{ i18n('Save') }}
            </primary-button>

            <Transition
                enter-active-class="transition ease-in-out"
                enter-from-class="opacity-0"
                leave-active-class="transition ease-in-out"
                leave-to-class="opacity-0">
                <p class="text-sm text-success"
                    v-if="form.recentlySuccessful">
                    {{ i18n('Success') }}
                </p>
            </Transition>
        </div>
    </form>
</template>

<script setup>
import { Link as HtmlLink, useForm } from '@inertiajs/vue3';
import { inject } from 'vue';
import { useLocales } from '@/handlers/locales';
import PasswordField from '@/components/forms/fields/PasswordField.vue';
import PrimaryButton from '@/components/ui/buttons/PrimaryButton.vue';
import SecondaryButton from '@/components/ui/buttons/SecondaryButton.vue';

const props = defineProps({
    alert: {
        type: String,
    },
    errors: {
        type: Object,
    },
    isMyProfile: {
        type: Boolean,
    },
    user: {
        type: Object,
    },
});

const { ai18n, i18n } = useLocales();
const route = route('route');
const user = props.user;

const form = useForm({
    password: null,
    password_confirmation: null,
});

const submit = () => {
    form.put(route('users.password.update', {user: user.id}), {
        onSuccess: () => form.reset(),
    });
};
</script>
