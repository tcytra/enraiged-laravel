<template>
    <vue-table ref="datatable"
        :page-report-template="'Showing {first} to {last} of {totalRecords} users'"
        :template="template"
        @show="show">
        <template v-slot:avatar="props">
            <avatar :action="props.data.actions.show" :avatar="props.data.avatar"/>
        </template>
        <template v-slot:unassignedUser="option">
            <span :class="option.class">{{ option.name }}</span>
        </template>
        <template v-slot:is_active="props">
            <primevue-badge severity="success" value="Yes" v-if="props.data.is_active"/>
            <primevue-badge severity="danger" value="No" v-else/>
        </template>
    </vue-table>
</template>

<script>
import Active from '@/components/ui/indicators/Active.vue';
import Avatar from '@/components/ui/avatars/Avatar.vue';
import PrimevueBadge from 'primevue/badge';
import VueTable from '@/components/tables/VueTable.vue';

export default {
    components: {
        Active,
        Avatar,
        PrimevueBadge,
        VueTable,
    },

    props: {
        template: {
            type: Object,
            required: true,
        },
    },

    methods: {
        show({ action, row }) {
            if (action.uri) {
                this.$inertia.get(action.uri);
            }
        },
    },
};
</script>
