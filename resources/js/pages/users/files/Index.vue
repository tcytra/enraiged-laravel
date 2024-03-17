<template>
    <main class="content main">
        <page-header back-button fixed :actions="actions" title="My Files"/>
        <section class="container">
            <primevue-dataview :layout="layout" :value="files" v-if="files.length">
                <template #header>
                    <primevue-dataview-layout-options class="mb-3" v-model="layout"/>
                </template>
                <template #list="{ items }">
                    <div class="bg-white flex mb-1 p-2 w-full" v-for="item in items" :key="item.id">
                        <div class="file-name mb-2">
                            <i :class="item.icon" style="font-size:2.5rem"></i>
                        </div>
                        <ul class="flex flex-column flex-grow-1 list-none">
                            <li class="mb-1">
                                {{ i18n('Name') }}:
                                <strong>{{item.name}}</strong>
                            </li>
                            <li class="mb-1">
                                {{ i18n('Created') }}:
                                <strong>{{ `${item.created.at.short} ${item.created.at.time}` }}</strong>
                            </li>
                        </ul>
                        <ul class="flex list-none">
                            <li>
                                <primevue-button class="p-button-rounded p-button-text p-button-success"
                                    icon="pi pi-download"
                                    v-tooltip.top="i18n('Download')"
                                    @click="download(item)"/>
                            </li>
                            <li>
                                <primevue-button class="p-button-rounded p-button-text p-button-danger"
                                    icon="pi pi-times"
                                    v-tooltip.top="i18n('Delete')"
                                    @click="destroy(item)"/>
                            </li>
                        </ul>
                    </div>
                </template>
                <template #grid="{ items }">
                    <div class="grid">
                        <div class="col-4 md:col-3 lg:col-2 mx-1" v-for="item in items" :key="item.id">
                            <primevue-card class="text-center">
                                <template #title>
                                    <div class="file-type mb-2">
                                        <strong>{{item.type}}</strong>
                                    </div>
                                </template>
                                <template #content>
                                    <div class="file-name mb-2">
                                        <i :class="item.icon" style="font-size:2.5rem"></i>
                                    </div>
                                    <div class="file-name mb-2">
                                        <span>{{ item.name }}</span>
                                    </div>
                                    <div class="file-date mb-2">
                                        <span>{{ item.created.at.short }}</span>
                                    </div>
                                    <div class="file-time mb-2">
                                        <span>{{ item.created.at.time }}</span>
                                    </div>
                                </template>
                                <template #footer>
                                    <div class="flex justify-content-between">
                                        <primevue-button class="p-button-rounded p-button-text p-button-success"
                                            icon="pi pi-download"
                                            v-tooltip.top="i18n('Download')"
                                            @click="download(item)"/>
                                        <primevue-button class="p-button-rounded p-button-text p-button-danger"
                                            icon="pi pi-times"
                                            v-tooltip.top="i18n('Delete')"
                                            @click="destroy(item)"/>
                                    </div>
                                </template>
                            </primevue-card>
                        </div>
                    </div>
                </template>
            </primevue-dataview>
            <div class="p-dataview-emptymessage" v-else>
                <span>{{ i18n('You do not have any files.') }}</span>
            </div>
        </section>
    </main>
</template>

<script>
import App from '@/layouts/App.vue';
import PageHeader from '@/components/ui/pages/PageHeader.vue';
import PrimevueButton from 'primevue/button/Button.vue';
import PrimevueCard from 'primevue/card/Card.vue';
import PrimevueDataview from 'primevue/dataview/DataView.vue';
import PrimevueDataviewLayoutOptions from 'primevue/dataviewlayoutoptions/DataViewLayoutOptions.vue';
import PrimevueTooltip from 'primevue/tooltip/tooltip.esm.js';

export default {
    layout: App,

    components: {
        PageHeader,
        PrimevueButton,
        PrimevueCard,
        PrimevueDataview,
        PrimevueDataviewLayoutOptions,
    },

    directives: {
        tooltip: PrimevueTooltip,
    },

    inject: [
        'i18n',
    ],

    props: {
        actions: {
            type: Object,
            required: true,
        },
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
        },
    },
};
</script>
