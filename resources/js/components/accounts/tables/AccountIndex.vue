<template>
    <div class="account-table">
        <primevue-datatable :value="data">
            <primevue-column v-for="(column, name, index) in builder.columns" :key="name"
                :class="column.class"
                :field="name"
                :header="column.label" />
        </primevue-datatable>
    </div>
</template>

<script>
import PrimevueDatatable from 'primevue/datatable';
import PrimevueColumn from 'primevue/column';
import PrimevueRow from 'primevue/row';

export default {
    components: {
        PrimevueDatatable,
        PrimevueColumn,
        PrimevueRow,
    },

    props: {
        builder: {
            type: Object,
            required: true,
        },
    },

    data: () => ({
        data: null,
    }),

    mounted() {
        this.getAccounts().then(data => this.data = data);
    },

    methods: {
        getAccounts() {
            return fetch('api/accounts/index/data')
                .then(res => res.json())
                .then(d => d.data)
                .catch(err => {
                    console.log(err);
                });
        },
    },
};
</script>
