<template>
    <Head title="Accounts" />
    <main class="accounts index content main">
        <header class="header">
            <h1>My Files</h1>
        </header>
        <section class="container files">
            <primevue-dataview :layout="layout" :value="files" v-if="files.length">
                <template #header>
                    <primevue-dataview-layout-options v-model="layout"/>
                </template>
                <template #list="props">
                    <div class="bg-white flex p-2 w-full">
                        <div class="file-name mb-2">
                            <i :class="props.data.icon" style="font-size:2.5rem"></i>
                        </div>
                        <ul class="flex flex-column flex-grow-1 list-none">
                            <li class="mb-1">
                                Name:
                                <strong>{{props.data.name}}</strong>
                            </li>
                            <li class="mb-1">
                                Created:
                                <strong>{{ `${props.data.created.date} ${props.data.created.time}` }}</strong>
                            </li>
                        </ul>
                        <ul class="flex list-none">
                            <li>
                                <primevue-button class="p-button-rounded p-button-text p-button-success"
                                    icon="pi pi-download"
                                    v-tooltip.top="'Download'"
                                    @click="download(props.data)"/>
                            </li>
                            <li>
                                <primevue-button class="p-button-rounded p-button-text p-button-danger"
                                    icon="pi pi-times"
                                    v-tooltip.top="'Delete'"
                                    @click="destroy(props.data)"/>
                            </li>
                        </ul>
                    </div>
                </template>
                <template #grid="props">
                    <div class="col-6 md:col-4 lg:col-3">
                        <primevue-card class="text-center">
                            <template #title>
                                <div class="file-type mb-2">
                                    <strong>{{props.data.type}}</strong>
                                </div>
                            </template>
                            <template #content>
                                <div class="file-name mb-2">
                                    <i :class="props.data.icon" style="font-size:2.5rem"></i>
                                </div>
                                <div class="file-name mb-2">
                                    <span>{{ props.data.name }}</span>
                                </div>
                                <div class="file-date mb-2">
                                    <span>{{ props.data.created.date }}</span>
                                </div>
                                <div class="file-time mb-2">
                                    <span>{{ props.data.created.time }}</span>
                                </div>
                            </template>
                            <template #footer>
                                <div class="flex justify-content-between">
                                    <primevue-button class="p-button-rounded p-button-text p-button-success"
                                        icon="pi pi-download"
                                        v-tooltip.top="'Download'"
                                        @click="download(props.data)"/>
                                    <primevue-button class="p-button-rounded p-button-text p-button-danger"
                                        icon="pi pi-times"
                                        v-tooltip.top="'Delete'"
                                        @click="destroy(props.data)"/>
                                </div>
                            </template>
                        </primevue-card>
                    </div>
                </template>
            </primevue-dataview>
            <div class="p-dataview-emptymessage" v-else>
                <span>You do not have any files.</span>
            </div>
        </section>
    </main>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';
import AppLayout from '@/layouts/App.vue';
import PrimevueButton from 'primevue/button';
import PrimevueCard from 'primevue/card';
import PrimevueDataview from 'primevue/dataview';
import PrimevueDataviewLayoutOptions from 'primevue/dataviewlayoutoptions';
import PrimevueTooltip from 'primevue/tooltip';

export default {
    layout: AppLayout,

    components: {
        Head,
        PrimevueButton,
        PrimevueCard,
        PrimevueDataview,
        PrimevueDataviewLayoutOptions,
    },

    directives: {
        tooltip: PrimevueTooltip,
    },

    props: {
        files: {
            type: Object,
            required: true,
        },
    },

    data: () => ({
        layout: 'grid',
    }),

    methods: {
        destroy(file) {
            this.$inertia.visit(`/files/${file.id}`, { method: 'delete' });
        },
        download(file) {
            window.location.href = `/files/${file.id}`;
            //this.$inertia.visit(`/files/${file.id}`, { method: 'get' });
        },
    },
};
</script>
