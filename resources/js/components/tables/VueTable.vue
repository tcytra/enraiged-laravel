<template>
    <primevue-datatable class="p-datatable-sm" :value="data">
        <template #empty>
            {{ template.empty || 'No records found' }}
        </template>
        <primevue-column v-for="(column, name, index) in template.columns" :key="name"
            :class="column.class"
            :field="name"
            :header="column.label" />
        <primevue-column v-if="template.actions.length" key="actions"
            class="actions"
            field="actions"
            header="Actions"
            v-bind="$props">
            <template #body="props">
                <primevue-button class="p-button-rounded p-button-sm p-button-text"
                    :class="button.class"
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
import PrimevueRow from 'primevue/row';
import PrimevueTooltip from 'primevue/tooltip';

export default {
    components: {
        PrimevueButton,
        PrimevueColumn,
        PrimevueDatatable,
        PrimevueRow,
    },

    directives: {
        tooltip: PrimevueTooltip,
    },

    props: {
        template: {
            type: Object,
            required: true,
        },
    },

    data: () => ({
        data: null,
        loading: false,
    }),

    async mounted() {
        await this.fetch()
            .then((data) => {
                this.data = data;
            });
    },

    methods: {
        ...mapActions(FlashMessages, ['flashSuccess']),
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
                    this.refresh();
                })
                .catch(error => this.trap(error));
        },
        fetch() {
            return fetch('api/accounts/index/data')
                .then(res => res.json())
                .then(d => d.data)
                .catch(error => this.trap(error));
        },
        refresh() {
            this.fetch()
                .then((data) => { this.data = data; });
        },
        success(status) {
            return status >= 200 && status < 300;
        },
        trap(error) {
            console.log(error);
        },
    },
};
</script>
