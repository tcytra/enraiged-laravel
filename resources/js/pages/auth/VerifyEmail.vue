<template>
    <div class="card container">
        <html-head :title="i18n('Email Verification')" />

        <div id="teleport" class="flex-centered">
            <div class="mask"></div>
            <primevue-card class="md:w-md w-sm">
                <template #header>
                    <h1 class="text-lg">{{ i18n('Email Verification') }}</h1>
                </template>
                <template #content>
                    <div class="mb-4 text-success text-sm font-medium" v-if="verificationLinkSent">
                        {{ i18n('A new verification link has been sent to your email address.') }}
                    </div>
                    <div class="mb-4 text-neutral text-sm" v-else>
                        {{ i18n('Please check your inbox for a verification email '
                            + 'and follow the provided instructions.') }}
                    </div>
                    <br>

                    <form class="form" @submit.prevent="submit">
                        <div class="mt-4 flex flex-row-reverse items-center justify-between">
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
    </div>
</template>

<script setup>
import { Head as HtmlHead, Link as HtmlLink, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';
import { useLocales } from '@/handlers/locales';
import PrimaryButton from '@/components/ui/buttons/PrimaryButton.vue';
import PrimevueCard from 'primevue/card';

const props = defineProps({
    status: {
        type: String,
    },
});

const { i18n } = useLocales();

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(
    () => props.status === 'verification-link-sent',
);
</script>
