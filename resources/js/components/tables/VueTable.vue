<template>
    <div :class="template.class">
        <div class="filter-controls grid m-0" v-if="template.filters">
            <div class="filter col-12" v-for="(field, name) in template.filters" :key="name"
                :class="['md:col-4', 'lg:col-3', 'xl:col-2', field.class]">
                <daterange-filter v-if="field.type === 'daterange'" :ref="name"
                    :field="field"
                    :form="filters"
                    :id="name"
                    @update:filterValue="filter(name)" />
                <dropdown-filter v-if="field.type === 'select'" :ref="name"
                    :field="field"
                    :form="filters"
                    :id="name"
                    @update:filterValue="filter(name)" />
            </div>
        </div>
        <primevue-datatable class="p-datatable-sm" ref="datatable"
            filter-display="menu"
            paginator-template="CurrentPageReport FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink"
            :current-page-report-template="pageReportTemplate"
            :first="first"
            :lazy="true"
            :loading="loading"
            :paginator="true"
            :responsive-layout="responsiveLayout"
            :row-class="rowClass"
            :rows="pagination.rows"
            :rows-per-page-options="template.pagination.options"
            :total-records="pagination.total"
            :value="records"
            @page="page($event)"
            @sort="sort($event)">
            <template #header>
                <div class="col controls-bar flex-order-1">
                    <primevue-button icon="pi pi-sync" class="table-fetch p-button-secondary mr-1"
                        v-tooltip.top="i18n('Refresh this data')"
                        @click="fetch()"/>
                    <primevue-button icon="pi pi-refresh" class="table-fresh p-button-secondary mr-1"
                        v-tooltip.top="i18n('Reset the table')"
                        @click="fresh()"/>
                    <primevue-dropdown class="pagination-rows width-64 ml-1" v-model="pagination.rows"
                        v-if="['array', 'object'].includes(typeof template.pagination.options)
                            && template.pagination.options.length"
                        :options="template.pagination.options"
                        @change="rows($event)"/>
                </div>
                <div class="col controls-bar flex-order-2 justify-content-end"
                    :class="['lg:flex-order-3']">
                    <div class="table-export width-112 ml-2" v-if="template.exportable">
                        <div class="p-inputgroup">
                            <primevue-dropdown v-model="exportable"
                                :options="template.exportable.options"/>
                            <primevue-button class="p-button-secondary" icon="pi pi-cloud-download"
                                v-tooltip.top="i18n('Export this data')"
                                :disabled="!records || !records.length"
                                @click="download()"/>
                        </div>
                    </div>
                    <span v-for="(button, name, index) in tableActions" :key="index">
                        <primevue-button
                            v-tooltip.top="i18n(button.tooltip)"
                            :class="['ml-2 pl-2', button.class, {'p-button-icon-only': !button.label}]"
                            :disabled="button.disabled"
                            :icon="button.icon"
                            :label="button.label"
                            @click="action(name, button)" />
                    </span>
                </div>
                <div class="search-bar col-12 flex-order-3" v-if="searchable"
                    :class="['lg:col-4 lg:flex-order-2']">
                    <div class="p-inputgroup">
                        <span class="p-inputgroup-addon">
                            <i class="pi pi-search"></i>
                        </span>
                        <primevue-inputtext v-model="search" :placeholder="i18n('Search for')"/>
                        <primevue-button icon="pi pi-times" class="p-button-secondary"
                            v-tooltip.top="'Clear the search'"
                            :disabled="!search || !search.length"
                            @click="search = null"/>
                    </div>
                </div>
            </template>
            <template #empty>
                {{ i18n(template.empty || 'No records found') }}
            </template>
            <primevue-column v-for="(column, name) in columns"
                :class="column.class"
                :field="name"
                :header="column.label"
                :key="name"
                :sortable="column.sortable && column.sortable !== false">
                <template #body="column" v-if="column.custom">
                    <slot :name="name" :data="column.data"/>
                </template>
            </primevue-column>
            <primevue-column v-if="Object.keys(rowActions).length"
                class="actions text-center" field="actions" key="actions"
                :class="[ actionsClass ]"
                :header="i18n('Actions')"
                v-bind="$props">
                <template #body="props">
                    <span v-for="(button, name) in rowActions">
                        <primevue-button class="p-button-rounded p-button-sm p-button-text"
                            :class="props.data.actions[name].class"
                            :disabled="props.data.actions[name].disabled"
                            :icon="props.data.actions[name].icon"
                            :key="name"
                            v-if="typeof props.data.actions[name] !== 'undefined'"
                            v-tooltip.top="i18n(props.data.actions[name].tooltip || name)"
                            @click="action(name, props.data.actions[name], props)"/>
                    </span>
                </template>
            </primevue-column>
        </primevue-datatable>
    </div>
</template>

<script>
import DaterangeFilter from './filters/DaterangeFilter.vue';
import DropdownFilter from './filters/DropdownFilter.vue';
import PrimevueButton from 'primevue/button/Button.vue';
import PrimevueColumn from 'primevue/column/Column.vue';
import PrimevueDatatable from 'primevue/datatable/DataTable.vue';
import PrimevueDropdown from 'primevue/dropdown/Dropdown.vue';
import PrimevueInputtext from 'primevue/inputtext/InputText.vue';
import PrimevueTooltip from 'primevue/tooltip/tooltip.esm.js';

export default {
    components: {
        DaterangeFilter,
        DropdownFilter,
        PrimevueButton,
        PrimevueColumn,
        PrimevueDatatable,
        PrimevueDropdown,
        PrimevueInputtext,
    },

    directives: {
        tooltip: PrimevueTooltip,
    },

    inject: [
        'actionHandler',
        'flash',
        'flashSuccess',
        'meta',
        'errorHandler',
        'i18n',
        'isSuccess',
    ],

    props: {
        actionsClass: {
            type: String,
            default: null,
        },
        pageReportTemplate: {
            type: String,
            default: '{first} - {last} / {totalRecords}',
        },
        responsiveLayout: {
            type: String,
            default: 'stack',
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
        columns() {
            let columns = {};
            Object.keys(this.template.columns)
                .filter((name) => name !== 'actions')
                .forEach((name) => columns[name] = this.template.columns[name]);
            return columns;
        },
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
        rowActions() {
            return this.actions('row');
        },
        searchable() {
            const columns = this.template.columns;
            return Object.keys(this.template.columns)
                .filter((name) => columns[name].searchable)
                .length > 0;
        },
        table() {
            return this.ready
                ? this.$refs.datatable
                : null;
        },
        tableActions() {
            return this.actions('table');
        },
    },

    created() {
        this.exportable = this.template.exportable ? this.template.exportable.default : null;
        if (this.template.state && this.template.id && localStorage[this.template.id]) {
            const state = JSON.parse(localStorage[this.template.id]);
            this.filters = state.filters;
            this.pagination = state.pagination;
            this.search = state.search;
        }
    },

    mounted() {
        this.ready = true;
        if (this.template.state && this.template.id && localStorage[this.template.id]) {
            const state = JSON.parse(localStorage[this.template.id]);
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
                const method = button.method || 'get';
                if (method === 'emit') {
                    this.$emit(name, props.data);
                } else
                if (button.uri && button.uri.match(/\/api/)) {
                    this.api(button.uri, method.toLowerCase());
                } else {
                    this.actionHandler(button, name);
                }
            }
        },

        actions(type) {
            let actions = {};
            Object.keys(this.template.actions).forEach((action) => {
                if (this.template.actions[action].type === type) {
                    actions[action] = this.template.actions[action];
                }
            });
            return actions;
        },

        api(uri, method) {
            this.axios.request({ method, url: uri })
                .then((response) => {
                    const { data, status } = response;
                    if (this.isSuccess(status)) {
                        if (data.success) {
                            this.flashSuccess(data.success);
                            this.fetch();
                        } else if (data.warn) {
                            const severity = Object.keys(data)[0];
                            this.flash({ severity, content: data.warn, expiry: 5000 });
                        }
                    }
                })
                .catch(error => this.errorHandler(error));
        },

        defaultFilters() {
            if (this.template.filters) {
                Object.keys(this.template.filters).forEach((filter) => {
                    this.filters[filter] = this.template.filters[filter].default || null;
                });
            }
        },

        download() {
            if (this.exportable) {
                this.loading = true;
                const headers = { responseType: 'blob' };
                const params = this.params();
                params.export = { name: this.template.id.replace(/[^A-Za-z]/g, '-'), type: this.exportable };
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
                const {records, pagination} = data;
                this.records = records;
                this.pagination = pagination;
                if (typeof document !== 'undefined') {
                    document.getElementById('page').scrollIntoView({ behavior: 'smooth' });
                }
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

        filter(field) {
            this.fetch();
            Object.keys(this.template.filters)
                .forEach((each) => {
                    if (typeof this.template.filters[each].options !== 'undefined'
                     && typeof this.template.filters[each].options.params !== 'undefined'
                     && this.template.filters[each].options.params.includes(field)) {
                        this.$refs[each][0].fetch(); // not sure why this ref ends up in an array
                    }
                });
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
            return typeof data.__ !== 'undefined'
                ? `background-${data.__}`
                : null;
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
