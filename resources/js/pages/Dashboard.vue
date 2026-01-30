<template>
    <main class="content main">
        <page-header fixed title="Dashboard" />
        <section class="card section">
            <primevue-card class="">
                <template #content>
                    <span>{{ i18n('Welcome to :app!').replace(':app', meta.name) }}</span>
                </template>
            </primevue-card>
        </section>
    </main>
</template>

<script setup>
import DefaultLayout from '@/layouts/DefaultLayout.vue';
import { inject } from 'vue';
import { useLocales } from '@/handlers/locales';
import PageHeader from '@/components/ui/PageHeader.vue';
import PrimevueCard from 'primevue/card';

defineOptions({
    layout: DefaultLayout,
});

const { i18n } = useLocales();
const { meta } = inject('app');
</script>
