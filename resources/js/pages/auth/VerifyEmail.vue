<template>
    <div class="verify panel">
        <page-header :title="title"/>
        <div class="body">
            <div>
                <p class="text-lg my-3">
                    {{ i18n('Please check your inbox for a verification email and follow the provided instructions.') }}
                </p>
                <p class="text-lg my-3" v-if="linkSent">
                    {{ i18n('A new verification link has been sent to your email address.') }}
                </p>
            </div>
        </div>
        <footer class="footer">
            <div class="submit container flex-row-reverse px-5">
                <primevue-button label="Resend Verification Email" class="p-button-secondary" @click="resend"/>
                <div class="flex">
                    <span class="cursor-pointer" @click="logout">Logout</span>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
import { router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/App.vue';
import PageHeader from '@/components/ui/pages/PageHeader.vue';
import PrimevueButton from 'primevue/button';

export default {
    layout: AppLayout,

    components: {
        PageHeader,
        PrimevueButton,
    },

    props: {
        flash: Object,
    },

    inject: ['i18n', 'logout'],

    computed: {
        success() {
            return this.flash && this.flash.status === 201;
        },
        title() {
            return this.success
                ? 'Verification Email Sent'
                : 'Email Verification Required';
        },
    },

    methods: {
        resend() {
            router.post('/email/verification-notification');
        },
    },
};
</script>
