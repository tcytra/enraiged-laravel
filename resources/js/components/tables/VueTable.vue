<template>
    <primevue-datatable class="p-datatable-sm" v-model:filters="search"
        filterDisplay="menu"
        paginatorTemplate="CurrentPageReport FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink"
        :current-page-report-template="pageReportTemplate"
        :first="first"
        :lazy="true"
        :loading="loading"
        :paginator="true"
        :rows="pagination.rows"
        :rows-per-page-options="template.pagination.options"
        :total-records="pagination.total"
        :value="records"
        @page="page($event)"
        @sort="sort($event)">
        <template #header>
            <div class="col controls-bar flex-order-1 lg:flex-order-1">
                <primevue-button icon="pi pi-sync" class="table-fetch p-button-secondary mr-1"
                    v-tooltip.top="'Refresh this data'"
                    @click="fetch()"/>
                <primevue-button icon="pi pi-refresh" class="table-fresh p-button-secondary mr-1"
                    v-tooltip.top="'Reset the table'"
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
                        v-tooltip.top="'Export this data'"
                        :disabled="!records || !records.length"
                        @click="download()"/>
                </div>
                <primevue-button class="create-button ml-2"
                    v-if="template.actions.create"
                    v-tooltip.top="template.actions.create.tooltip"
                    :class="template.actions.create.class"
                    :disabled="!template.actions.create.permission"
                    :icon="template.actions.create.icon"
                    @click="action('create', template.actions.create)"/>
            </div>
            <div class="search-bar p-inputgroup col-12 flex-order-3 lg:col-4 lg:flex-order-2">
                <span class="p-inputgroup-addon">
                    <i class="pi pi-search"></i>
                </span>
                <primevue-inputtext v-model="search" placeholder="Keyword Search"/>
                <primevue-button icon="pi pi-times" class="p-button-secondary"
                    :disabled="!search || !search.length"
                    @click="fresh()"/>
            </div>
        </template>
        <template #empty>
            {{ template.empty || 'No records found' }}
        </template>
        <primevue-column v-for="(column, name, index) in template.columns" :key="name"
            :class="column.class"
            :field="name"
            :header="column.label"
            :sortable="column.sortable"/>
        <primevue-column v-if="template.actions" key="actions"
            class="actions"
            field="actions"
            header="Actions"
            v-bind="$props">
            <template #body="props">
                <primevue-button class="p-button-rounded p-button-sm p-button-text"
                    :class="button.class"
                    :disabled="!button.permission"
                    :icon="button.icon"
                    :key="name"
                    v-for="(button, name) in props.data.actions"
                    v-tooltip.top="button.tooltip || name"
                    @click="action(name, button, props)"/>
            </template>
        </primevue-column>
    </primevue-datatable>
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

    props: {
        pageReportTemplate: {
            type: String,
            default: null,
        },
        template: {
            type: Object,
            required: true,
        },
    },

    data: () => ({
        exportable: null,
        filters: null,
        loading: false,
        pagination: {
            dir: null,
            page: null,
            rows: null,
            sort: null,
            total: 0,
        },
        records: null,
        search: null,
        timer: null,
    }),

    computed: {
        dirty() {
            return (this.pagination.page != this.template.pagination.page)
                || (this.pagination.sort != this.template.pagination.sort)
                || (this.pagination.rows != this.template.pagination.rows)
                || (this.filters || this.search);
        },
        first() {
            return this.pagination.page && this.pagination.rows
                ? (this.pagination.page * this.pagination.rows) - this.pagination.rows
                : 0;
        },
    },

    async mounted() {
        this.exportable = this.template.exportable.default;
        if (this.template.state && this.template.id && localStorage[this.template.id]) {
            const state = JSON.parse(localStorage[this.template.id]);
            this.filters = state.filters;
            this.pagination = state.pagination;
            this.search = state.search;
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
            return this.axios.get('api/accounts/index/data', { params: this.params() })
                .then(response => this.fetched(response))
                .catch(error => this.trap(error));
        },

        action(name, button, props, confirmed) {
            if (button.confirm && confirmed !== true) {
                this.$confirm.require({
                    message: typeof button.confirm === 'string' ? button.confirm : 'Are you sure you want to proceed?',
                    header: 'Confirmation',
                    icon: 'pi pi-exclamation-triangle',
                    acceptClass: 'p-button-danger',
                    accept: () => this.action(name, button, props, true),
                });
            } else {
                const method = button.method || 'get';
                if (!button.uri || method === 'emit') {
                    this.$emit(name, { action: button, row: props });
                } else if (button.uri.match(/\/api/)) {
                    this.api(button.uri, method);
                } else {
                    this.$inertia.visit(button.uri, { method, body: props });
                }
            }
        },

        api(uri, method) {
            const { meta } = this.$page.props;
            const params = {
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-Token': meta.csrf_token,
                },
                method: method.toUpperCase(),
            };
            return fetch(uri, params)
                .then((response) => {
                    const { status } = response;
                    return this.success(status) ? response.json() : false;
                })
                .then((data) => {
                    const { success } = data;
                    this.flashSuccess(success);
                    this.fetch();
                })
                .catch(error => this.trap(error));
        },

        download() {
            if (this.exportable) {
                // this.loading = true;
                const headers = { responseType: 'blob' };
                const params = this.params();
                params.export = { name: 'accounts', type: this.exportable };
                this.axios.post(this.template.exportable.uri, params, { headers: headers })
                    .then(response => this.downloaded(response))
                    .catch(error => this.trap(error));
            }
        },

        downloaded(response) {
            this.loading = false;
            const { status, data } = response;
            if (this.success(status)) {
                if (data.success) {
                    this.flashSuccess(data.success);
                } else {
                    const url = window.URL.createObjectURL(new Blob([data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', 'file.xlsx'); //or any other extension
                    document.body.appendChild(link);
                    link.click();
                    /*filesystem.writeFile('accounts.xlsx', JSON.stringify(response.data), function (err) {
                        console.log(err);
                    });
                    console.log(response);*/
                }
            } else {
                this.trap(response);
            }
        },

        fetched(response) {
            this.loading = false;
            const { status, data } = response;
            if (this.success(status)) {
                const {filters, records, search, pagination} = data;
                this.filters = filters;
                this.records = records;
                this.search = search;
                this.pagination = pagination;
            } else {
                this.trap(response);
            }
        },

        fresh() {
            this.pagination.dir = null;
            this.pagination.page = 1;
            this.pagination.rows = this.template.pagination.rows;
            this.pagination.sort = null;
            this.search = null;
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

        rows(event) {
            this.pagination.rows = event.value;
            this.fetch()
        },

        sort(event) {
            this.pagination.dir = event.sortOrder;
            this.pagination.sort = event.sortField;
            this.fetch();
        },

        success(status) {
            return status >= 200 && status < 300;
        },

        trap(error) {
            // console.log(error);
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
