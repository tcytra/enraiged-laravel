<template>
    <main class="content main">
        <page-header back-button fixed :heading="page.heading" :title="page.title"/>
        <section class="auto-margin container max-width-lg">
            <primevue-card>
                <template #header>
                    <header class="header">
                        <h3 class="auto-margin max-width-md">
                            {{ i18n('Please provide the following information to create a new user.') }}
                        </h3>
                    </header>
                </template>
                <template #content>
                    <div class="auto-margin container max-width-md">
                        <vue-form :template="template" creating/>
                    </div>
                </template>
            </primevue-card>
        </section>
    </main>
</template>

<script>
import App from '@/layouts/App.vue';
import PageHeader from '@/components/ui/pages/PageHeader.vue';
import PrimevueCard from 'primevue/card/Card.vue';
import VueForm from '@/components/forms/VueForm.vue';

export default {
    layout: App,

    components: {
        PageHeader,
        PrimevueCard,
        VueForm,
    },

    inject: ['i18n'],

    props: {
        page: {
            type: Object,
            required: true,
        },
        template: {
            type: Object,
            required: true,
        },
    },
};
</script>
