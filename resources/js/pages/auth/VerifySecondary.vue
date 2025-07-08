<template>
    <div class="card container">
        <html-head :title="i18n('Secondary Verification')" />

        <primevue-card class="md:w-md w-sm">
            <template #header>
                <h1 class="text-lg">{{ i18n('Secondary Verification') }}</h1>
            </template>
            <template #content>
                <div class="mb-4 text-sm font-medium text-green-600" v-if="verificationLinkSent">
                    {{ i18n('A verification link has been sent to your secondary email address.') }}
                </div>
                <div class="mb-4 text-sm text-gray-600" v-else>
                    {{ i18n('Please check your inbox for a verification email and follow the provided instructions.') }}
                </div>

                <form @submit.prevent="submit">
                    <div class="mt-4 flex items-center justify-between">
                        <primary-button
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                            @click="submit">
                            {{ i18n('Resend Verification Email') }}
                        </primary-button>

                        <html-link class="text-link text-sm"
                            as="button" method="post"
                            :href="route('logout')">
                            {{ i18n('Logout') }}
                        </html-link>
                    </div>
                </form>
            </template>
        </primevue-card>
    </div>
</template>

<script setup>
import { Head as HtmlHead, Link as HtmlLink, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';
import { trans as i18n } from 'laravel-vue-i18n';
import DefaultLayout from '@/layouts/DefaultLayout.vue';
import PrimaryButton from '@/components/ui/buttons/PrimaryButton.vue';
import PrimevueCard from 'primevue/card';

defineOptions({
    layout: DefaultLayout,
});

const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    form.post(route('secondary.verification.send'));
};

const verificationLinkSent = computed(
    () => props.status === 'secondary-verification-link-sent',
);
</script>
