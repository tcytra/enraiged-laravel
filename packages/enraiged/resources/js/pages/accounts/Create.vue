<template>
    <main class="content main">
        <page-header back-button title="Create Account"/>
        <section class="auto-margin container max-width-lg">
            <primevue-card>
                <template #header>
                    <header class="header">
                        <h3 class="auto-margin max-width-md">
                            {{ i18n('Please provide the following information to create a new account.') }}
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
import AppLayout from '@/layouts/App.vue';
import PageHeader from '@/components/ui/pages/PageHeader.vue';
import PrimevueCard from 'primevue/card';
import VueForm from '@/components/forms/VueForm.vue';

export default {
    layout: AppLayout,

    components: {
        PageHeader,
        PrimevueCard,
        VueForm,
    },

    inject: ['i18n'],

    props: {
        template: {
            type: Object,
            required: true,
        },
    },
};
</script>
