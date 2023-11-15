<template>
    <primevue-card>
        <template #content>
            <div class="user-summary flex flex-row">
                <avatar action="/my/avatar" class="width-96 mr-3" size="xl"
                    :avatar="user.avatar"
                    :editable="user.is_myself"/>
                <div class="descriptions flex-grow-1 flex flex-row">
                    <div class="description-lists mr-3">
                        <dl>
                            <dt>{{ i18n('Profile Name') }}:</dt>
                            <dd>{{ user.profile.name }}</dd>
                        </dl>
                        <dl>
                            <dt>{{ i18n('Email Address') }}:</dt>
                            <dd>{{ user.email }}</dd>
                        </dl>
                    </div>
                    <div class="description-lists mr-3">
                        <dl>
                            <dt>{{ i18n('Profile Created') }}:</dt>
                            <dd>
                                {{ user.created.date }}
                                {{ user.created.time }}
                            </dd>
                        </dl>
                        <dl>
                            <dt>{{ i18n('Last Updated') }}:</dt>
                            <dd v-if="user.created.timestamp === user.updated.timestamp">
                                <em class="empty">-</em>
                            </dd>
                            <dd v-else>
                                {{ user.updated.date }}
                                {{ user.updated.time }}
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
import PrimevueCard from 'primevue/card/Card.vue';

export default {
    components: {
        Avatar,
        PrimevueCard,
    },

    inject: ['i18n'],

    props: {
        user: {
            type: Object,
            required: true,
        },
    },
};
</script>
