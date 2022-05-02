<template>
    <main class="account content dashboard flex-column main flex">
        <header class="flex header justify-content-between">
            <Head :title="pageTitle"/>
            <h1 v-if="account.id === 1">My Account</h1>
            <h1 v-else>Account</h1>
            <div class="actions">
                <div class="action edit-avatar" @click="edit('/my/account/avatar')">
                    <primevue-button class="button p-button-info p-button-text"
                        icon="pi pi-circle"
                        label="Avatar"/>
                </div>
                <div class="action edit-login" @click="edit('/my/account/login')">
                    <primevue-button class="button p-button-info p-button-text"
                        icon="pi pi-sign-in"
                        label="Login"/>
                </div>
                <div class="action edit-profile" @click="edit('/my/account/profile')">
                    <primevue-button class="button p-button-info p-button-text"
                        icon="pi pi-user"
                        label="Profile"/>
                </div>
            </div>
        </header>
        <section class="align-self-center container max-width-xl w-full">
            <div class="grid">
                <div class="col-12" v-if="help">
                    <primevue-message class="m-0" @close="help = false">
                        These are your private account details.
                    </primevue-message>
                </div>
                <div class="col-12">
                    <account-summary :account="account" :is-my-account="isMyAccount"/>
                </div>
                <div class="col-4">
                    <primevue-card>
                        <template #content>
                            contacts
                        </template>
                    </primevue-card>
                </div>
                <div class="col-4">
                    <primevue-card>
                        <template #content>
                            networks
                        </template>
                    </primevue-card>
                </div>
                <div class="col-4">
                    <primevue-card>
                        <template #content>
                            profiles
                        </template>
                    </primevue-card>
                </div>
            </div>
        </section>
    </main>
</template>

<script>
import { mapState } from 'pinia';
import { Auth } from '@/stores/auth.js';
import { Head } from '@inertiajs/inertia-vue3';
import AccountSummary from '@/components/accounts/cards/AccountSummary.vue';
import AppLayout from '@/layouts/App.vue';
import PrimevueButton from 'primevue/button';
import PrimevueCard from 'primevue/card';
import PrimevueMessage from 'primevue/message';

export default {
    layout: AppLayout,

    components: {
        AccountSummary,
        Head,
        PrimevueButton,
        PrimevueCard,
        PrimevueMessage,
    },

    props: {
        account: {
            type: Object,
            required: true,
        },
    },

    data: () => ({
        actions: {
            avatar: '',
            login: '',
            profile: '',
        },
        help: true,
    }),

    computed: {
        ...mapState(Auth, ['user']),
        isMyAccount() {
            return this.user ? this.user.id === this.account.id : false;
        },
        pageTitle() {
            return this.isMyAccount ? 'My Account' : 'Account';
        },
    },

    methods: {
        edit(route) {
            this.$inertia.get(route);
        },
    },
};
</script>
