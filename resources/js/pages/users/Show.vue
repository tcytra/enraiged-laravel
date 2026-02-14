<template>
    <main class="content main">
        <page-header back-button fixed :actions="actions" :title="title" />

        <section class="card profile section">
            <primevue-message class="mb-3" severity="error" v-if="user.status === 'deleted'">
                {{ i18n('This user was deleted on :date by :name.')
                    .replace(':date', user.deleted.at.date)
                    .replace(':name', user.deleted.by.name) }}
            </primevue-message>
            <primevue-message class="mb-3" severity="warn" v-else-if="user.status === 'inactive'">
                {{ i18n('This user account is currently deactivated.') }}
            </primevue-message>

            <header class="relative h-[16rem]">
                <div class="relative h-[8rem] flex items-end justify-between bg-surface-300 dark:bg-surface-700"
                    style="border-radius: var(--p-border-radius-xl) var(--p-border-radius-xl) 0 0">
                    <div class="px-3 py-1 text-sm">
                        <div>{{ i18n('Account Created:') }} {{ user.created.at.date }}</div>
                        <div>{{ i18n('Last Updated:') }} {{ user.updated.at.date }}</div>
                    </div>
                    <div class="px-3 py-1"></div>
                </div>
                <div class="relative h-[8rem] flex items-start justify-between bg-surface-200 dark:bg-surface-600"
                    style="border-radius: 0 0 var(--p-border-radius-xl) var(--p-border-radius-xl)">
                    <div class="px-3 py-1"></div>
                    <div class="px-3 py-1"></div>
                </div>
                <div class="absolute h-[16rem] w-full top-0 flex items-center justify-center">
                    <avatar :avatar="user.avatar" size="xx" />
                </div>
            </header>
        </section>

        <section class="card section">
            <primevue-card class="">
                <template #content>
                    <span>{{ i18n(':name Profile').replace(':name', props.user.name) }}</span>
                </template>
            </primevue-card>
        </section>
    </main>
</template>

<script setup>
import DefaultLayout from '@/layouts/DefaultLayout.vue';
import { computed } from 'vue';
import { useLocales } from '@/handlers/locales';
import Avatar from '@/components/ui/avatars/Avatar.vue';
import PageHeader from '@/components/ui/PageHeader.vue';
import PrimevueCard from 'primevue/card';
import PrimevueMessage from 'primevue/message';

defineOptions({
    layout: DefaultLayout,
});

const props = defineProps({
    actions: {
        type: Object,
        default: {},
    },
    user: {
        type: Object,
        required: true,
    },
});

const { i18n } = useLocales();

const title = computed(() => props.user.name);
</script>
