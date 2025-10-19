<template>
    <header>
        <p class="text-neutral text-sm">
            {{ i18n("Update your account's profile information and email address.") }}
        </p>
    </header>
    <form class="form" @submit.prevent="submit">
        <div class="grid grid-cols-1 lg:grid-cols-2 mt-5 gap-4">
            <dropdown-field class="mb-3" id="salut"
                :errors="errors"
                :field="{
                    label: 'Salutation',
                    options: {
                        values: [
                            {id: 'Dr', 'name': 'Dr'},
                            {id: 'Hon', 'name': 'Hon'},
                            {id: 'Miss', 'name': 'Miss'},
                            {id: 'Mr', 'name': 'Mr'},
                            {id: 'Mrs', 'name': 'Mrs'},
                            {id: 'Ms', 'name': 'Ms'},
                            {id: 'Professor', 'name': 'Professor'},
                        ],
                    },
                    placeholder: 'Optional',
                    type: 'dropdown',
                }"
                :form="form" />
            <text-field class="mb-3" id="name"
                :errors="errors"
                :field="{
                    label: 'Full Name',
                    placeholder: 'Required',
                    type: 'text',
                }"
                :form="form" />
            <text-field id="email"
                :errors="errors"
                :field="{
                    label: allowSecondaryCredential ? 'Primary Email' : 'Email Address',
                    placeholder: 'Required',
                    type: 'email',
                }"
                :form="form" />
            <text-field id="username" v-if="allowSecondaryCredential"
                :errors="errors"
                :field="{
                    label: allowUsernameLogin ? 'Secondary Email or Username' : 'Secondary Email',
                    placeholder: 'Optional',
                    type: allowUsernameLogin ? 'text' : 'email',
                }"
                :form="form" />
        </div>

        <!--
        <div class="grid grid-cols-1 lg:grid-cols-2 mt-5 gap-4" v-if="mustVerifyEmail">
            <p class="mt-2 text-sm text-neutral">
                <html-link as="button" class="text-link" method="post" :href="route('verification.send')">
                    {{ i18n('Click here to re-send the verification email.') }}
                </html-link>
            </p>
            <div class="mt-2 text-sm text-success" v-show="status === 'verification-link-sent'">
                {{ i18n('A new verification link has been sent to your email address.') }}
            </div>
        </div>
        -->
        <!--
        <div v-if="mustVerifySecondary">
            <p class="mt-2 text-sm text-warning" v-show="!status">
                {{ i18n('This email address must be verified before it can be used to log in.') }}
            </p>
            <p class="mt-2 text-sm text-neutral" v-show="!status">
                <html-link as="button" class="text-link" method="post" :href="route('secondary.verification.send')">
                    {{ i18n('Click here to re-send the verification email.') }}
                </html-link>
            </p>
            <p class="mt-2 text-sm text-success" v-show="status === 'secondary-verification-link-sent'">
                {{ i18n('A verification link has been sent to your secondary email address.') }}
            </p>
        </div>
        -->

        <div class="flex flex-row-reverse items-center gap-4 mt-6">
            <primary-button :disabled="form.processing" @click="submit()">
                {{ i18n('Save') }}
            </primary-button>

            <secondary-button size="small" :disabled="form.processing || !form.isDirty" @click="form.reset()">
                {{ i18n('Reset') }}
            </secondary-button>

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
import DropdownField from '@/components/forms/fields/DropdownField.vue';
import PrimaryButton from '@/components/ui/buttons/PrimaryButton.vue';
import SecondaryButton from '@/components/ui/buttons/SecondaryButton.vue';
import TextField from '@/components/forms/fields/TextField.vue';

const props = defineProps({
    allowSecondaryCredential: {
        type: Boolean,
    },
    allowUsernameLogin: {
        type: Boolean,
    },
    errors: {
        type: Object,
    },
    isMyProfile: {
        type: Boolean,
    },
    isProtectedUser: {
        type: Boolean,
    },
    mustVerifyEmail: {
        type: Boolean,
    },
    mustVerifySecondary: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    user: {
        type: Object,
    },
});

const { state } = inject('app');
const { i18n } = inject('intl');

const user = props.user;

const form = useForm({
    salut: user.salut,
    email: user.email,
    name: user.name,
    username: user.username,
});

const submit = () => {
    const url = props.isMyProfile
        ? route('my.profile.update')
        : route('users.update', {user: user.id})
    form.patch(url, {
        onSuccess: () => {
            if (props.isMyProfile) {
                state();
            }
        },
    });
};
</script>
