<template>
    <main class="content flex-column main flex">
        <page-header :title="i18n('Dashboard')"/>
        <section class="align-self-center container max-width-xl w-full">
            <primevue-card class="mb-3">
                <template #content>
                    <p class="mb-1">{{ i18n('This is your dashboard.') }}</p>
                </template>
            </primevue-card>
            <primevue-card class="mb-3">
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
