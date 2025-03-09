<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';
import { trans as i18n } from 'laravel-vue-i18n';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const user = usePage().props.auth.user;

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route('users.destroy', {user: user.id}), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.clearErrors();
    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ i18n('Delete Account') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                <span class="font-bold">
                    {{ i18n('Warning!') }}
                </span> <span class="font-normal">
                    {{ i18n('This action cannot be undone.') }}
                    {{ i18n('Please be sure to download any data or information that you wish to retain.') }}
                </span>
            </p>
        </header>

        <DangerButton @click="confirmUserDeletion">
            {{ i18n('Delete Account') }}
        </DangerButton>

        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    {{ i18n('Are you sure you want to delete your account?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ i18n('Please provide your password to confirm you would like to permanently delete your account.') }}
                </p>

                <div class="mt-6">
                    <InputLabel class="sr-only" for="password" :value="i18n('Password')" />

                    <TextInput
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-3/4"
                        :placeholder="i18n('Password')"
                        @keyup.enter="deleteUser" />

                    <InputError class="mt-2" :message="i18n(form.errors.password)" v-if="form.errors.password" />
                </div>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal">
                        {{ i18n('Cancel') }}
                    </SecondaryButton>

                    <DangerButton
                        class="ms-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser">
                        {{ i18n('Delete Account') }}
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
