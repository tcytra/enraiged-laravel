<template>
    <main class="content main">
        <page-header back-button :actions="account.actions" :header="header" :title="title"/>
        <section class="auto-margin container max-width-xl w-full">
            <div class="grid">
                <page-messages class="col-12" :messages="messages" @dismiss="messages.splice($event, 1)"/>
                <div class="col-12">
                    <account-summary :account="account"/>
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
import AccountSummary from '@/components/accounts/cards/AccountSummary.vue';
import AppLayout from '@/layouts/App.vue';
import PageHeader from '@/components/ui/pages/PageHeader.vue';
import PageMessages from '@/components/ui/pages/PageMessages.vue';
import PrimevueCard from 'primevue/card';

export default {
    layout: AppLayout,

    components: {
        AccountSummary,
        PageHeader,
        PageMessages,
        PrimevueCard,
    },

    inject: ['i18n'],

    props: {
        account: {
            type: Object,
            required: true,
        },
        messages: {
            type: Array,
            default: [],
        },
    },

    computed: {
        header() {
            return this.account.is_myself
                ? 'My Account'
                : `${this.i18n('Account')}: ${this.account.profile.name}`;
        },
        title() {
            return this.account.is_myself
                ? this.header
                : 'Account Dashboard';
        },
    },
};
</script>
