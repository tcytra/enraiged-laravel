<template>
    <main class="content main">
        <page-header back-button fixed :actions="actions" title="My Files"/>
        <section class="container">
            <primevue-dataview :layout="layout" :value="files" v-if="files.length">
                <template #header>
                    <primevue-dataview-layout-options class="mb-3" v-model="layout"/>
                </template>
                <template #list="props">
                    <div class="bg-white flex p-2 w-full">
                        <div class="file-name mb-2">
                            <i :class="props.data.icon" style="font-size:2.5rem"></i>
                        </div>
                        <ul class="flex flex-column flex-grow-1 list-none">
                            <li class="mb-1">
                                {{ i18n('Name') }}:
                                <strong>{{props.data.name}}</strong>
                            </li>
                            <li class="mb-1">
                                {{ i18n('Created') }}:
                                <strong>{{ `${props.data.created.at.short} ${props.data.created.at.time}` }}</strong>
                            </li>
                        </ul>
                        <ul class="flex list-none">
                            <li>
                                <primevue-button class="p-button-rounded p-button-text p-button-success"
                                    icon="pi pi-download"
                                    v-tooltip.top="i18n('Download')"
                                    @click="download(props.data)"/>
                            </li>
                            <li>
                                <primevue-button class="p-button-rounded p-button-text p-button-danger"
                                    icon="pi pi-times"
                                    v-tooltip.top="i18n('Delete')"
                                    @click="destroy(props.data)"/>
                            </li>
                        </ul>
                    </div>
                </template>
                <template #grid="props">
                    <div class="col-4 md:col-3 lg:col-2 mx-1">
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
                                    <span>{{ props.data.created.at.short }}</span>
                                </div>
                                <div class="file-time mb-2">
                                    <span>{{ props.data.created.at.time }}</span>
                                </div>
                            </template>
                            <template #footer>
                                <div class="flex justify-content-between">
                                    <primevue-button class="p-button-rounded p-button-text p-button-success"
                                        icon="pi pi-download"
                                        v-tooltip.top="i18n('Download')"
                                        @click="download(props.data)"/>
                                    <primevue-button class="p-button-rounded p-button-text p-button-danger"
                                        icon="pi pi-times"
                                        v-tooltip.top="i18n('Delete')"
                                        @click="destroy(props.data)"/>
                                </div>
                            </template>
                        </primevue-card>
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

    inject: ['i18n'],

    props: {
        actions: {
            type: Array,
            default: [],
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
        back() {
            window.history.go(-1);
        },
        destroy(file) {
            this.$inertia.visit(`/files/${file.id}`, { method: 'delete' });
        },
        download(file) {
            window.location.href = `/files/${file.id}`;
        },
    },
};
</script>
