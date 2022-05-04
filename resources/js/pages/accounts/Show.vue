<template>
    <main class="content main">
        <page-header back-button :actions="actions" :title="title"/>
        <section class="auto-margin container max-width-xl w-full">
            <div class="grid">
                <div class="col-12" v-if="help && myself">
                    <primevue-message class="m-0" @close="help = false">
                        These are your private account details.
                    </primevue-message>
                </div>
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
import PrimevueCard from 'primevue/card';
import PrimevueMessage from 'primevue/message';

export default {
    layout: AppLayout,

    components: {
        AccountSummary,
        PageHeader,
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
        help: true,
    }),

    computed: {
        actions() {
            return this.account.actions;
        },
        myself() {
            return this.$attrs.auth.user.id === this.account.id;
        },
        title() {
            return this.myself ? 'My Account' : 'Account';
        },
    },
};
</script>
