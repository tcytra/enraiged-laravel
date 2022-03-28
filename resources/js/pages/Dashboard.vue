<template>
    <Head title="Dashboard" />
    <main class="content dashboard main">
        <header class="header">
            <h1>Dashboard</h1>
        </header>
        <section class="container">
            <primevue-card class="mb-3">
                <template #content>
                    This is your authorized dashboard.
                </template>
            </primevue-card>
            <!--
            <div class="flex flex-row">
                <div class="cta">
                    <primevue-card>
                        <template #content>Laravel 9</template>
                    </primevue-card>
                </div>
                <div class="cta">
                    <primevue-card>
                        <template #content>Vue 3</template>
                    </primevue-card>
                </div>
                <div class="cta">
                    <primevue-card>
                        <template #content>Inertia.js</template>
                    </primevue-card>
                </div>
                <div class="cta">
                    <primevue-card>
                        <template #content>PrimeVUE</template>
                    </primevue-card>
                </div>
            </div>
            -->
        </section>
    </main>
</template>

<script>
import AppLayout from '@/layouts/App.vue';
import { Head } from '@inertiajs/inertia-vue3';
import PrimevueCard from 'primevue/card';

export default {
    layout: AppLayout,
    components: {
        Head,
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
