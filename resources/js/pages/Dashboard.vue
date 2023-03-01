<template>
    <main class="content flex-column main flex">
        <page-header fixed :title="i18n('Dashboard')"/>
        <section class="align-self-center container max-width-xl w-full">
            <primevue-card class="mb-3 shadow-1">
                <template #header>
                    <header class="header">
                        <h3>{{ i18n('This is your dashboard.') }}</h3>
                    </header>
                </template>
                <template #content>
                    <p class="mb-3">
                        {{ user.profile.name }}
                    </p>
                    <p class="mb-3">
                        clientSize: {{ clientSize.toUpperCase() }} clientWidth: {{ clientWidth }}px
                        <em v-if="isMobile || isTablet">
                            ({{ isMobile ? 'mobile' : '' }}{{ isTablet ? 'tablet' : '' }} width)
                        </em>
                    </p>
                    <p class="mb-1">
                        {{ meta.app_version }}
                    </p>
                </template>
            </primevue-card>
        </section>
    </main>
</template>

<script>
import App from '@/layouts/App.vue';
import PageHeader from '@/components/ui/pages/PageHeader.vue';
import PrimevueCard from 'primevue/card/Card.vue';

export default {
    layout: App,

    components: {
        PageHeader,
        PrimevueCard,
    },

    inject: ['clientSize', 'clientWidth', 'i18n', 'isMobile', 'isTablet', 'meta', 'user'],
};
</script>
