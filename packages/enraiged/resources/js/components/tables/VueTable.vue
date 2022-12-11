<template>
    <div :class="template.class">
        <div class="filter-controls p-card p-component vue-form" v-if="template.filters">
            <div v-for="(filter, name) in template.filters">
                <primevue-dropdown optionLabel="name" optionValue="id" show-clear
                    class="col col-6 md:col-4 lg:col-3 xl:col-2 p-0"
                    v-model="filters[name]"
                    :id="name"
                    :options="filter.options.values"
                    :placeholder="filter.placeholder"
                    @update:modelValue="fetch"/>
            </div>
        </div>
        <primevue-datatable class="p-datatable-sm" ref="datatable"
            filterDisplay="menu"
            paginatorTemplate="CurrentPageReport FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink"
            :current-page-report-template="pageReportTemplate"
            :first="first"
            :lazy="true"
            :loading="loading"
            :paginator="true"
            :row-class="rowClass"
            :rows="pagination.rows"
            :rows-per-page-options="template.pagination.options"
            :total-records="pagination.total"
            :value="records"
            @page="page($event)"
            @sort="sort($event)">
            <template #header>
                <div class="col controls-bar flex-order-1 lg:flex-order-1">
                    <primevue-button icon="pi pi-sync" class="table-fetch p-button-secondary mr-1"
                        v-tooltip.top="i18n('Refresh this data')"
                        @click="fetch()"/>
                    <primevue-button icon="pi pi-refresh" class="table-fresh p-button-secondary mr-1"
                        v-tooltip.top="i18n('Reset the table')"
                        @click="fresh()"/>
                    <primevue-dropdown class="pagination-rows width-64 ml-1" v-model="pagination.rows"
                        :options="template.pagination.options"
                        @change="rows($event)"/>
                </div>
                <div class="col controls-bar flex-order-2 lg:flex-order-3 justify-content-end">
                    <div class="table-export p-inputgroup width-112 ml-2" v-if="template.exportable">
                        <primevue-dropdown v-model="exportable"
                            :options="template.exportable.options"/>
                        <primevue-button class="p-button-secondary" icon="pi pi-cloud-download"
                            v-tooltip.top="i18n('Export this data')"
                            :disabled="!records || !records.length"
                            @click="download()"/>
                    </div>
                    <primevue-button class="create-button ml-2"
                        v-if="template.actions.create && template.actions.create.permission"
                        v-tooltip.top="i18n(template.actions.create.tooltip)"
                        :class="template.actions.create.class"
                        :disabled="!template.actions.create.permission"
                        :icon="template.actions.create.icon"
                        @click="action('create', template.actions.create)"/>
                </div>
                <div class="search-bar p-inputgroup col-12 flex-order-3 lg:col-4 lg:flex-order-2">
                    <span class="p-inputgroup-addon">
                        <i class="pi pi-search"></i>
                    </span>
                    <primevue-inputtext v-model="search" :placeholder="i18n('Search for')"/>
                    <primevue-button icon="pi pi-times" class="p-button-secondary"
                        v-tooltip.top="'Clear the search'"
                        :disabled="!search || !search.length"
                        @click="fresh()"/>
                </div>
            </template>
            <template #empty>
                {{ i18n(template.empty || 'No records found') }}
            </template>
            <primevue-column v-for="(column, name, index) in template.columns" :key="name"
                :class="column.class"
                :field="name"
                :header="column.label"
                :sortable="column.sortable">
                <template #body="column" v-if="column.custom">
                    <slot :name="name" :data="column.data"/>
                </template>
            </primevue-column>
            <primevue-column v-if="template.actions" key="actions"
                class="actions"
                field="actions"
                :header="i18n('Actions')"
                v-bind="$props">
                <template #body="props">
                    <primevue-button class="p-button-rounded p-button-sm p-button-text"
                        :class="button.class"
                        :disabled="!button.permission"
                        :icon="button.icon"
                        :key="name"
                        v-for="(button, name) in props.data.actions"
                        v-tooltip.top="i18n(button.tooltip || name)"
                        @click="action(name, button, props)"/>
                </template>
            </primevue-column>
        </primevue-datatable>
    </div>
</template>

<script>
import { mapActions } from 'pinia';
import { FlashMessages } from '@/stores/flashmessages.js';
import PrimevueButton from 'primevue/button';
import PrimevueColumn from 'primevue/column';
import PrimevueDatatable from 'primevue/datatable';
import PrimevueDropdown from 'primevue/dropdown';
import PrimevueInputtext from 'primevue/inputtext';
import PrimevueRow from 'primevue/row';
import PrimevueTooltip from 'primevue/tooltip';

export default {
    components: {
        PrimevueButton,
        PrimevueColumn,
        PrimevueDatatable,
        PrimevueDropdown,
        PrimevueInputtext,
        PrimevueRow,
    },

    directives: {
        tooltip: PrimevueTooltip,
    },

    inject: ['actionHandler', 'appMeta', 'errorHandler', 'i18n', 'isSuccess'],

    props: {
        pageReportTemplate: {
            type: String,
            default: '{first} - {last} / {totalRecords}',
        },
        template: {
            type: Object,
            required: true,
        },
    },

    data: () => ({
        exportable: null,
        filters: {},
        loading: false,
        pagination: {
            dir: null,
            page: null,
            rows: null,
            sort: null,
            total: 0,
        },
        ready: false,
        records: null,
        search: null,
        timer: null,
    }),

    computed: {
        dirty() {
            return (this.pagination.page != this.template.pagination.page)
                || (this.pagination.sort != this.template.pagination.sort)
                || (this.pagination.rows != this.template.pagination.rows)
                || (Object.keys(this.filters).length || this.search);
        },
        first() {
            return this.pagination.page && this.pagination.rows
                ? (this.pagination.page * this.pagination.rows) - this.pagination.rows
                : 0;
        },
        table() {
            return this.ready
                ? this.$refs.datatable
                : null;
        },
    },

    async mounted() {
        this.ready = true;
        this.exportable = this.template.exportable ? this.template.exportable.default : null;
        this.defaultFilters();
        if (this.template.state && this.template.id && localStorage[this.template.id]) {
            const state = JSON.parse(localStorage[this.template.id]);
            this.filters = state.filters;
            this.pagination = state.pagination;
            this.search = state.search;
            this.table.d_sortField = state.pagination.sort;
            this.table.d_sortOrder = state.pagination.dir;
            localStorage.removeItem(this.template.id);
            this.fetch();
        } else {
            this.fresh();
        }
    },

    beforeUnmount() {
        if (this.template.state && this.template.id && this.dirty) {
            const state = {
                filters: this.filters,
                pagination: this.pagination,
                search: this.search,
            };
            localStorage[this.template.id] = JSON.stringify(state);
        }
    },

    methods: {
        ...mapActions(FlashMessages, ['flashSuccess']),

        async fetch() {
            this.loading = true;
            return this.axios.get(this.template.uri, { params: this.params() })
                .then(response => this.fetched(response))
                .catch(error => this.errorHandler(error));
        },

        action(name, button, props, confirmed) {
            if (button.confirm && confirmed !== true) {
                this.$confirm.require({
                    message: typeof button.confirm === 'string'
                        ? this.i18n(button.confirm)
                        : this.i18n('Are you sure you want to proceed?'),
                    header: this.i18n('Please confirm'),
                    icon: 'pi pi-exclamation-triangle',
                    acceptClass: 'p-button-danger',
                    acceptLabel: this.i18n('Yes'),
                    rejectLabel: this.i18n('No'),
                    accept: () => this.action(name, button, props, true),
                });
            } else {
                if (button.uri && button.uri.match(/\/api/)) {
                    const method = button.method || 'get';
                    this.api(button.uri, method.toLowerCase());
                } else {
                    this.actionHandler(button, 'button:clicked');
                }
            }
        },

        api(uri, method) {
            this.axios.request({ method, url: uri })
                .then((response) => {
                    const { data, status } = response;
                    if (this.isSuccess(status)) {
                        const { success } = data;
                        this.flashSuccess(success);
                        this.fetch();
                    } else {
                        this.errorHandler(error);
                    }
                })
                .catch(error => this.errorHandler(error));
        },

        defaultFilters() {
            Object.keys(this.template.filters).forEach((filter) => {
                this.filters[filter] = this.template.filters[filter].default || null;
            });
        },

        download() {
            if (this.exportable) {
                this.loading = true;
                const headers = { responseType: 'blob' };
                const params = this.params();
                params.export = { name: 'accounts', type: this.exportable };
                this.axios.post(this.template.exportable.uri, params, { headers: headers })
                    .then((response) => {
                        this.loading = false;
                        const { status, data } = response;
                        if (this.isSuccess(status) && data.success) {
                            this.flashSuccess(data.success);
                        }
                    })
                    .catch(error => this.errorHandler(error));
            }
        },

        fetched(response) {
            this.loading = false;
            const { status, data } = response;
            if (this.isSuccess(status)) {
                const {filters, records, search, pagination} = data;
                this.filters = filters;
                this.records = records;
                this.search = search;
                this.pagination = pagination;
            } else {
                this.errorHandler(response);
            }
        },

        fresh() {
            this.defaultFilters();
            this.pagination.dir = null;
            this.pagination.page = 1;
            this.pagination.rows = this.template.pagination.rows;
            this.pagination.sort = null;
            this.search = null;
            this.table.d_sortField = null;
            this.table.d_sortOrder = null;
            this.fetch();
        },

        page(event) {
            this.pagination.page = event.page + 1;
            this.pagination.rows = event.rows;
            this.fetch();
        },

        params() {
            return {
                filters: this.filters,
                ...this.pagination,
                search: this.search,
            };
        },

        rowClass(data) {
            return {
                'inactive-data': typeof data.active !== undefined && !data.active,
            };
        },

        rows(event) {
            this.pagination.rows = event.value;
            this.fetch()
        },

        sort(event) {
            this.pagination.dir = event.sortOrder;
            this.pagination.sort = event.sortField;
            this.fetch();
        },
    },

    watch: {
        search: {
            handler(value) {
                clearTimeout(this.timer);
                if (!value || !value.length || value.length > 1) {
                    this.timer = setTimeout(this.fetch, 500);
                }
            }
        },
    },
};
</script>
