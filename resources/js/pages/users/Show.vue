<template>
    <main class="content main">
        <page-header back-button :actions="user.actions" :heading="heading" :title="title"/>
        <section class="auto-margin container max-width-xl w-full">
            <div class="grid">
                <page-messages class="col-12" :messages="messages" @dismiss="messages.splice($event, 1)"/>
                <div class="col-12">
                    <user-summary :user="user"/>
                </div>
                <!--
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
                -->
            </div>
        </section>
    </main>
</template>

<script>
import AppLayout from '@/layouts/App.vue';
import UserSummary from '@/components/users/cards/UserSummary.vue';
import PageHeader from '@/components/ui/pages/PageHeader.vue';
import PageMessages from '@/components/ui/pages/PageMessages.vue';
import PrimevueCard from 'primevue/card/Card.vue';

export default {
    layout: AppLayout,

    components: {
        PageHeader,
        PageMessages,
        PrimevueCard,
        UserSummary,
    },

    inject: ['i18n'],

    props: {
        messages: {
            type: Array,
            default: [],
        },
        user: {
            type: Object,
            required: true,
        },
    },

    computed: {
        heading() {
            return this.user.is_myself
                ? 'My Profile'
                : `${this.i18n('User')}: ${this.user.profile.name}`;
        },
        title() {
            return this.user.is_myself
                ? this.heading
                : 'User Dashboard';
        },
    },
};
</script>
