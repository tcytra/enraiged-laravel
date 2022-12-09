<template>
    <primevue-card>
        <template #content>
            <div class="account-summary">
                <avatar action="/my/account/avatar" class="width-96" size="xl"
                    :avatar="account.avatar"
                    :editable="account.is_myself"/>
                <div class="descriptions flex-grow-1">
                    <div class="description-lists">
                        <dl>
                            <dt>{{ i18n('Account Name') }}:</dt>
                            <dd>{{ account.profile.name }}</dd>
                        </dl>
                        <dl>
                            <dt>{{ i18n('Email Address') }}:</dt>
                            <dd>{{ account.email }}</dd>
                        </dl>
                    </div>
                    <div class="description-lists">
                        <dl>
                            <dt>{{ i18n('Account Created') }}:</dt>
                            <dd>
                                {{ account.created.date }}
                                {{ account.created.time }}
                            </dd>
                        </dl>
                        <dl>
                            <dt>{{ i18n('Last Updated') }}:</dt>
                            <dd v-if="account.created.timestamp === account.updated.timestamp">
                                <em class="empty">-</em>
                            </dd>
                            <dd v-else>
                                {{ account.updated.date }}
                                {{ account.updated.time }}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </template>
    </primevue-card>
</template>

<script>
import Avatar from '@/components/ui/avatars/Avatar.vue';
import PrimevueCard from 'primevue/card';

export default {
    components: {
        Avatar,
        PrimevueCard,
    },

    inject: ['i18n'],

    props: {
        account: {
            type: Object,
            required: true,
        },
    },
};
</script>
