<template>
    <main class="content main">
        <page-header fixed title="Dashboard" />
        <section class="card section px-6">
            <primevue-card class="">
                <template #content>
                    <span>{{ i18n('Welcome to :app!').replace(':app', meta.name) }}</span>
                </template>
            </primevue-card>
        </section>
    </main>
</template>

<script setup>
import { inject } from 'vue';
import PageHeader from '@/components/ui/PageHeader.vue';
import PrimevueCard from 'primevue/card';

const { i18n } = inject('intl');
const { meta } = inject('app');
</script>
