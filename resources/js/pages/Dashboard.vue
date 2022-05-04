<template>
    <main class="content flex-column main flex">
        <page-header title="Dashboard"/>
        <section class="align-self-center container max-width-xl w-full">
            <primevue-card class="mb-3">
                <template #content>
                    This is your dashboard.
                </template>
            </primevue-card>
        </section>
    </main>
</template>

<script>
import AppLayout from '@/layouts/App.vue';
import PageHeader from '@/components/ui/pages/PageHeader.vue';
import PrimevueCard from 'primevue/card';

export default {
    layout: AppLayout,

    components: {
        PageHeader,
        PrimevueCard,
    },
};
</script>

<style lang="scss">
#app {
    .dashboard {
        .flex-row {
            .cta {
                flex-grow: 1;
                height: 10rem;
                margin-left: .5rem;
                margin-right: .5rem;
                &:first-child {
                    margin-left: 0;
                }
                &:last-child {
                    margin-right: 0;
                }
                .p-card, .p-card .p-card-body {
                    height: inherit;
                }
                .p-card .p-card-body {
                    align-items: center;
                    display: flex;
                    flex-direction: column;
                    font-family: 'Helvetica Neue Condensed', 'Helvetica Nueue', 'Helvetica', sans-serif;
                    font-size: 2rem;
                    justify-content: center;
                }
            }
        }
    }
}
</style>
