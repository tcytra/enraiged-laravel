<template>
    <div :class="template.class">
        <primevue-datatable :class="template.class" ref="datatable" v-model:selection="selection"
            filter-display="menu"
            paginator-template="CurrentPageReport FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink"
            :current-page-report-template="pageReportTemplate"
            :data-key="selectableKey"
            :first="first"
            :group-rows-by="groupRowsBy"
            :lazy="true"
            :loading="loading"
            :paginator="showPaginator && template.pagination !== null"
            :responsive-layout="responsiveLayout"
            :row-class="rowClass"
            :row-group-mode="groupRowsBy ? rowGroupMode : null"
            :rows="pagination.rows"
            :rows-per-page-options="template.pagination.options"
            :scrollable="enableScrollable"
            :total-records="pagination.total"
            :value="records"
            @page="page($event)"
            @sort="sort($event)">
            <template #header v-if="showControls">
                <slot name="header" v-bind="{
                    template, fetch, fresh, filter, records, selection, batchActionOptions, batch, tableActions,
                }">
                    <div class="flex left gap-2">
                        <div class="bar control">
                            <primevue-inputgroup>
                                <primevue-inputgroup-addon>
                                    <primevue-button icon="pi pi-sync" class="table-fetch" size="small"
                                        v-tooltip.top="i18n('Refresh this data')"
                                        @click="fetch()"/>
                                </primevue-inputgroup-addon>
                                <primevue-inputgroup-addon>
                                    <primevue-button icon="pi pi-refresh" class="table-fresh" size="small"
                                        v-tooltip.top="i18n('Reset the table')"
                                        @click="fresh()"/>
                                </primevue-inputgroup-addon>
                                <primevue-select class="pagination-rows w-[80px]" size="small" v-model="pagination.rows"
                                    v-if="['array', 'object'].includes(typeof template.pagination.options)
                                        && template.pagination.options.length"
                                    :options="template.pagination.options"
                                    @change="rows($event)"/>
                            </primevue-inputgroup>
                        </div>
                        <slot name="filters" v-bind="{ filter, filters }">
                            <vue-table-filters class="control filter" ref="tableFilters" v-if="template.filters"
                                :filter="filter"
                                :filters="template.filters"
                                :form="filters" />
                        </slot>
                    </div>
                    <div class="flex right gap-2">
                        <div class="bar search" v-if="searchable">
                            <primevue-inputgroup>
                                <primevue-inputgroup-addon>
                                    <i class="pi pi-search text-sm"></i>
                                </primevue-inputgroup-addon>
                                <primevue-inputtext v-model="search" size="small" :placeholder="i18n('Search for')"/>
                                <primevue-inputgroup-addon>
                                    <primevue-button icon="pi pi-times" class="p-button-secondary" size="small"
                                        v-tooltip.top="i18n('Clear the search')"
                                        :disabled="!search || !search.length"
                                        @click="search = null"/>
                                </primevue-inputgroup-addon>
                            </primevue-inputgroup>
                        </div>
                        <div class="bar export" v-if="isExportable">
                            <primevue-inputgroup>
                                <primevue-select v-model="exporttype" size="small"
                                    :options="template.exportable.options"/>
                                <primevue-inputgroup-addon>
                                    <primevue-button icon="pi pi-cloud-download" size="small"
                                        v-tooltip.top="i18n('Export this data')"
                                        :disabled="!records.length"
                                        @click="exporter()"/>
                                </primevue-inputgroup-addon>
                            </primevue-inputgroup>
                        </div>
                        <div class="bar batch" v-if="hasBatchActions">
                            <div class="p-inputgroup">
                                <primevue-select class="w-full" optionLabel="name" size="small" v-model="selected"
                                    :disabled="!selection.length"
                                    :options="batchActionOptions"
                                    :placeholder="i18n('Select rows')"/>
                                <primevue-button class="p-button-secondary" icon="pi pi-database" size="small"
                                    v-tooltip.top="i18n('Execute batch action')"
                                    :disabled="!selection.length && !selected"
                                    @click="batch()"/>
                            </div>
                        </div>
                        <div class="bar control">
                            <span v-for="(button, name, index) in tableActions" :key="index">
                                <primevue-button size="small"
                                    v-tooltip.top="i18n(button.tooltip)"
                                    :class="[button.class, {'p-button-icon-only': !button.label}]"
                                    :disabled="button.disabled"
                                    :icon="button.icon"
                                    :label="i18n(button.label)"
                                    @click="action(name, button)"/>
                            </span>
                        </div>
                    </div>
                </slot>
            </template>
            <template #empty>
                {{ i18n(template.empty || 'No records found') }}
            </template>
            <!--<template #groupfooter="props">
                <slot name="groupfooter" v-bind="props"/>
            </template>-->
            <template #groupheader="props">
                <slot name="groupheader" v-bind="props">
                    <strong>{{ props.data[groupRowsBy] }}</strong>
                </slot>
            </template>
            <primevue-column selectionMode="multiple" headerStyle="width:2rem" v-if="isSelectable"></primevue-column>
            <primevue-column v-for="(column, name) in columns"
                :alignFrozen="columnFrozenAlign(column)"
                :class="column.class"
                :field="name"
                :frozen="columnFrozen(column)"
                :header="column.label"
                :key="name"
                :sortable="column.sortable && column.sortable !== false">
                <template #body="column" v-if="column.custom">
                    <slot :name="name" :data="column.data"/>
                </template>
            </primevue-column>
            <primevue-column v-if="hasRowActions"
                class="actions text-center" field="actions" key="actions"
                :class="[ actionsClass ]"
                :header="i18n('Actions')"
                v-bind="$props">
                <template #body="props">
                    <span v-for="(item, name) in props.data.actions" :key="name">
                        <primevue-button class="" size="small"
                            :class="item.class"
                            :disabled="item.disabled"
                            :icon="item.icon"
                            :severity="item.severity"
                            :variant="item.variant"
                            v-if="typeof name !== 'undefined'"
                            v-tooltip.top="i18n(item.tooltip || name)"
                            @click="action(name, item, props)"/>
                    </span>
                </template>
            </primevue-column>
            <primevue-column-group type="footer" v-if="enableSums && false">
                <primevue-row>
                    <primevue-column v-if="isSelectable"/>
                    <primevue-column v-for="(column, name) in columns"
                        :alignFrozen="columnFrozenAlign(column)"
                        :frozen="columnFrozen(column)"
                        :key="name">
                        <primevue-column :footer="sums[column]" footerStyle="text-align:right"/>
                    </primevue-column>
                    <primevue-column v-if="Object.keys(rowActions).length"/>
                </primevue-row>
            </primevue-column-group>
        </primevue-datatable>
        <primevue-confirm-dialog></primevue-confirm-dialog>
    </div>
</template>

<script>
import { router } from '@inertiajs/vue3';
import PrimevueButton from 'primevue/button';
import PrimevueColumn from 'primevue/column';
import PrimevueColumnGroup from 'primevue/columngroup';
import PrimevueConfirmDialog from 'primevue/confirmdialog';
import PrimevueDatatable from 'primevue/datatable';
import PrimevueInputgroup from 'primevue/inputgroup';
import PrimevueInputgroupAddon from 'primevue/inputgroupaddon';
import PrimevueInputtext from 'primevue/inputtext';
import PrimevueRow from 'primevue/row';
import PrimevueSelect from 'primevue/select';
import PrimevueTooltip from 'primevue/tooltip';
import VueTableFilters from './VueTableFilters.vue';

export default {
    components: {
        PrimevueButton,
        PrimevueColumn,
        PrimevueColumnGroup,
        PrimevueConfirmDialog,
        PrimevueDatatable,
        PrimevueInputgroup,
        PrimevueInputgroupAddon,
        PrimevueInputtext,
        PrimevueRow,
        PrimevueSelect,
        VueTableFilters,
    },

    directives: {
        tooltip: PrimevueTooltip,
    },

    inject: [
        'app',
        'intl',
        //'flash',
        //'flashSuccess',
    ],

    props: {
        actionsClass: {
            type: String,
            default: null,
        },
        autoDownload: {
            type: Boolean,
            default: false,
        },
        groupRowsBy: {
            type: String,
            default: null,
        },
        hasRowActions: {
            type: Boolean,
            default: false,
        },
        pageReportTemplate: {
            type: String,
            default: '{first} - {last} / {totalRecords}',
        },
        responsiveLayout: {
            type: String,
            default: 'stack',
        },
        rowGroupMode: {
            type: String,
            default: 'subheader',
        },
        scrollable: {
            type: Boolean,
            default: false,
        },
        selectable: {
            type: [Boolean, String],
            default: null,
        },
        showControls: {
            type: Boolean,
            default: true,
        },
        showPaginator: {
            type: Boolean,
            default: true,
        },
        template: {
            type: Object,
            required: true,
        },
    },

    data: () => ({
        exporttype: null,
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
        records: [],
        search: null,
        selected: null,
        selection: [],
        sums: [],
        timer: null,
    }),

    computed: {
        batchActions() {
            return this.actions('multiple');
        },
        batchActionOptions() {
            let actions = [];
            Object.keys(this.batchActions)
                .forEach((action) => {
                    actions.push({id: action, name: this.template.actions[action].label});
                });
            return actions;
        },
        columns() {
            let columns = {};
            Object.keys(this.template.columns)
                .filter((name) => name !== 'actions')
                .filter((name) => typeof this.template.columns[name].hidden === 'undefined'
                    || this.template.columns[name].hidden !== true)
                .forEach((name) => columns[name] = this.template.columns[name]);
            return columns;
        },
        dirty() {
            return (this.pagination.page != this.template.pagination.page)
                || (this.pagination.sort != this.template.pagination.sort)
                || (this.pagination.rows != this.template.pagination.rows)
                || (Object.keys(this.filters).length || this.search);
        },
        enableAutoDownload() {
            return this.autoDownload
                || this.template.exportable.autodownload;
        },
        enableScrollable() {
            return this.scrollable === true
                || this.template.scrollable === true;
        },
        enableSums() {
            const columns = this.template.columns;
            return Object.keys(this.template.columns)
                .filter((name) => columns[name].sum)
                .length > 0;
        },
        i18n() {
            return this.intl.i18n;
        },
        first() {
            return this.pagination.page && this.pagination.rows
                ? (this.pagination.page * this.pagination.rows) - this.pagination.rows
                : 0;
        },
        hasBatchActions() {
            return this.batchActionOptions.length > 0;
        },
        /*hasState() {
            return localStorage.getItem(this.template.id) !== null;
        },*/
        isExportable() {
            return typeof this.template.exportable !== 'undefined'
                && this.template.exportable !== null;
        },
        isSelectable() {
            return (this.selectable || this.template.selectable);;
        },
        meta() {
            return this.app.meta;
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
        selectableKey() {
            if (this.isSelectable) {
                return typeof this.selectable === 'string'
                    ? this.selectable
                    : 'id';
            }
            return null;
        },
        table() {
            return this.ready
                ? this.$refs.datatable
                : null;
        },
        tableActions() {
            return this.actions('table', 'multiple');
        },
    },

    created() {
        if (this.isExportable && typeof this.template.exportable.default !== 'undefined') {
            this.exporttype = this.template.exportable.default;
        }
        if (this.isSelectable) {
            this.selected = this.batchActionOptions[0];
        }
    },

    mounted() {
        this.ready = true;
        if (this.template.state && this.template.id && localStorage[this.template.id]) {
            const state = JSON.parse(localStorage[this.template.id]);
            this.filters = state.filters;
            this.pagination = state.pagination;
            this.search = state.search;
            this.table.d_sortField = state.pagination.sort;
            this.table.d_sortOrder = (state.pagination.dir * 1);
            if (!state.search) {
                this.fetch();
            }
        } else {
            this.fresh();
        }
        localStorage.removeItem(this.template.id);
    },

    beforeMount() {
        this.defaultFilters();
        if (this.enableSums && this.records.length) {
            this.calculateSums();
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
            const url = route(this.template.fetch);
            this.loading = true;
            this.selection = [];

            return axios.get(url, { params: this.params() })
                .then(response => this.fetched(response))
                .catch(error => this.errorHandler(error));
        },

        actionHandler() {
            //
        },

        action(name, action, props, confirmed) {
            if (action.confirm && confirmed !== true) {
                this.confirm(action, () => this.action(name, action, props, true));
            } else {
                const method = action.route.method || 'get';
                if (method === 'emit') {
                    props
                        ? this.$emit(name, props.data)
                        : this.$emit(name);
                } else
                if (action.route) {
                    if (action.route.api || action.route.url.match(/\/api/)) {
                        if (action.download) {
                            this.download(action);
                        } else {
                            this.api(action.route.url, method.toLowerCase());
                        }
                    } else {
                        // this.actionHandler(action, name);
                        router[method](action.route.url);
                    }
                }
            }
        },

        actions(search, not) {
            let actions = {};
            Object.keys(this.template.actions)
                .forEach((action) => {
                    const template = this.template.actions[action].type;
                    if (typeof template === 'string' && template === search
                        || (Array.isArray(template) && template.includes(search)
                            && (typeof not === 'undefined' || !template.includes(not)))) {
                        actions[action] = this.template.actions[action];
                    }
                });
            return actions;
        },

        api(url, method, params, success) {
            axios.request({ method, url, params })
                .then((response) => {
                    const { data, status } = response;
                    if (data.success) {
                        // this.flashSuccess(data.success);
                        this.fetch();
                        if (typeof success === 'function') {
                            success();
                        }
                    } else if (data.warn) {
                        // const severity = Object.keys(data)[0];
                        // this.flash({ severity, content: data.warn, expiry: 5000 });
                    }
                    if (status === 205) {
                        router.get('/');
                    }
                })
                .catch(error => this.errorHandler(error));
        },

        batch(confirmed) {
            const action = this.template.actions[this.selected.id];
            const selected = this.selection.map((row) => row.id);
            if (action.confirm && confirmed !== true) {
                this.confirm(action, () => this.batch(true));
            } else if (action.method === 'emit') {
                this.$emit(`batch:${this.selected.id}`, action, selected);
            } else {
                this.api(action.uri, action.method, {selected}, () => this.selection = []);
            }
        },

        calculateSums(index) {
            if (typeof index !== 'undefined') {
                let total = 0;
                if (this.records.length) {
                    this.records.forEach((row) => {
                        if (row[index]) {
                            const amount = row[index].replace(/[^\d\.]/g, '');
                            total = total + (amount * 1);
                        }
                    });
                }
                this.sums[index] = total
                    ? total.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')
                    : null;
            } else {
                this.sums = [];
                Object.keys(this.template.columns)
                    .forEach((index) => {
                        if (this.template.columns[index].sum !== 'undefined'
                         && this.template.columns[index].sum === true) {
                            this.calculateSums(index);
                        }
                    });
            }
        },

        columnFrozen(column) {
            return typeof column.frozen !== 'undefined' && column.frozen !== false;
        },

        columnFrozenAlign(column) {
            return typeof column.frozen !== 'undefined' && typeof column.frozen === 'string'
                ? column.frozen
                : null;
        },

        confirm(action, accept) {
            this.$confirm.require({
                message: typeof action.confirm === 'string'
                    ? this.i18n(action.confirm)
                    : this.i18n('Are you sure you want to proceed?'),
                header: this.i18n('Please confirm'),
                icon: 'pi pi-exclamation-triangle',
                acceptClass: 'p-button-danger',
                rejectClass: 'p-button-secondary',
                acceptLabel: this.i18n('Yes'),
                rejectLabel: this.i18n('No'),
                accept,
            });
        },

        defaultFilters() {
            if (this.template.filters) {
                Object.keys(this.template.filters).forEach((filter) => {
                    this.filters[filter] = this.template.filters[filter].value || null;
                });
            }
        },

        download(downloadable, parameters) {
            const { route } = downloadable;
            this.loading = true;
            const params = {
                method: route.method || 'post',
                url: route.url,
                data: {...this.params(), ...parameters},
                responseType: 'blob',
            };
            axios.request(params)
                .then((response) => {
                    this.loading = false;
                    const { data, headers, status } = response;
                    if (status >= 200 && status < 300) {
                        if (headers['content-type'].match(/^application/)) {
                            const url = window.URL.createObjectURL(new Blob([data]));
                            const link = document.createElement('a');
                            const file = headers['content-disposition'].split('=')[1].replace(/"/g, '');
                            link.href = url;
                            link.setAttribute('download', file);
                            document.body.appendChild(link);
                            link.click();
                        } else if (data.success) {
                            //this.flashSuccess(data.success);
                        }
                    }
                })
                .catch(error => this.errorHandler(error));
        },

        errorHandler(error) {
            //
        },

        exporter() {
            if (this.exporttype && this.template.exportable) {
                if (this.enableAutoDownload || this.template.exportable.autodownload) {
                    this.download(this.template.exportable, {export: this.exporttype});
                } else {
                    this.api(this.template.exportable.uri, 'post', {...this.params(), export: this.exporttype});
                }
            }
        },

        fetched(response) {
            this.loading = false;
            const { status, data } = response;
            if (status >= 200 && status < 300) {
                const {records, pagination} = data;
                this.records = records;
                this.pagination = pagination;
                if (typeof document !== 'undefined') {
                    document.getElementById('app').scrollIntoView({ behavior: 'smooth' });
                }
                if (this.enableSums) {
                    this.calculateSums();
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
            this.table.d_sortField = null;
            this.table.d_sortOrder = null;
            if (typeof this.search === 'string') {
                this.search = null;
            } else {
                this.fetch();
            }
        },

        filter(field) {
            Object.keys(this.template.filters)
                .forEach((each) => {
                    //  we need to clear any dependant filter values
                    if (this.filterDependant(field, each)) {
                        this.filters[each] = null;
                    }
                });
            this.fetch();
            Object.keys(this.template.filters)
                .forEach((each) => {
                    //  we need to refetch any dependant filter values
                    if (this.filterDependant(field, each)) {
                        const filter = this.$refs.tableFilters.filterRefName(each);
                        this.$refs.tableFilters.$refs[filter][0].fetch();
                    }
                });
        },

        filterDependant(field, filter) {
            return typeof this.template.filters[filter].options !== 'undefined'
                && typeof this.template.filters[filter].options.params !== 'undefined'
                && this.template.filters[filter].options.params.includes(field);
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
                selection: this.isSelectable && this.selection.length
                    ? this.selection.map((row) => row.id)
                    : null,
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
