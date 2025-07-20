<template>
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

    <danger-button class="mt-6" label="confirm" @click="confirm.open()">
        {{ i18n('Delete Account') }}
    </danger-button>

    <confirm-dialog ref="confirm" @accepted="submit">
        <template #container="{ message, acceptCallback, rejectCallback }">
            <div class="flex flex-col items-center p-8 bg-surface-0 dark:bg-surface-900 rounded">
                <span class="font-bold text-2xl block mb-2 mt-6">
                    {{ i18n('Please Confirm') }}
                </span>
                <p class="mb-0">
                    {{ i18n('Are you sure you want to delete your account?') }}
                </p>
                <form class="form my-6 w-full" @submit.prevent="submit">
                    <password-field id="password"
                        :field="{
                            label: 'Current Password',
                            placeholder: 'Required',
                            type: 'password',
                        }"
                        :form="form" />
                </form>
                <div class="flex items-center gap-2 mt-6">
                    <primary-button class="w-32"
                        :label="i18n('Yes')"
                        @click="submit" />
                    <outlined-button  class="w-32"
                        :label="i18n('No')"
                        @click="rejectCallback" />
                </div>
            </div>
        </template>
    </confirm-dialog>
</template>

<script setup>
import { Link as HtmlLink, useForm } from '@inertiajs/vue3';
import { inject, ref } from 'vue';
import ConfirmDialog from '@/components/ui/dialogs/ConfirmDialog.vue';
import DangerButton from '@/components/ui/buttons/DangerButton.vue';
import PasswordField from '@/components/forms/fields/PasswordField.vue';
import PrimaryButton from '@/components/ui/buttons/PrimaryButton.vue';
import OutlinedButton from '@/components/ui/buttons/OutlinedButton.vue';

defineProps({
    status: {
        type: String,
    },
});

const { auth } = inject('app');
const { i18n } = inject('intl');
const confirm = ref('confirm');

const form = useForm({
    password: null,
});

const submit = () => {
    //const url = route('users.destroy', {user: auth.id});
    //router.delete(url);
    form.delete(route('users.destroy', {user: auth.id}));
};
</script>
