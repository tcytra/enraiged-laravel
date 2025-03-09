<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import { trans as i18n } from 'laravel-vue-i18n';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const user = usePage().props.auth.user;

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('users.password.update', {user: user.id}), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ i18n('Update Password') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ i18n('Ensure your account is using a long, random password to stay secure.') }}
            </p>
        </header>

        <form @submit.prevent="updatePassword" class="mt-6 space-y-6">
            <div>
                <InputLabel for="current_password" :value="i18n('Current Password')" />

                <TextInput
                    id="current_password"
                    ref="currentPasswordInput"
                    v-model="form.current_password"
                    :placeholder="i18n('Required')"
                    type="password"
                    class="mt-1 block w-full"
                    autocomplete="current-password" />

                <InputError class="mt-2" :message="i18n(form.errors.current_password)" v-if="form.errors.current_password" />
            </div>

            <div>
                <InputLabel for="password" :value="i18n('New Password')" />

                <TextInput
                    id="password"
                    ref="passwordInput"
                    v-model="form.password"
                    :placeholder="i18n('Required')"
                    type="password"
                    class="mt-1 block w-full"
                    autocomplete="new-password" />

                <InputError class="mt-2" :message="i18n(form.errors.password)" v-if="form.errors.password" />
            </div>

            <div>
                <InputLabel for="password_confirmation" :value="i18n('Confirm Password')" />

                <TextInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    :placeholder="i18n('Required')"
                    type="password"
                    class="mt-1 block w-full"
                    autocomplete="new-password" />

                <InputError class="mt-2" :message="form.errors.password_confirmation" v-if="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">
                    {{ i18n('Save') }}
                </PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0">
                    <p class="text-sm text-gray-600" v-if="form.recentlySuccessful">
                        {{ i18n('Success') }}
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
