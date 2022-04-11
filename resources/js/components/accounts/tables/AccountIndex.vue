<template>
    <div class="account-table">
        <vue-table :template="template"
            @show="show" />
    </div>
</template>

<script>
import VueTable from '@/components/tables/VueTable.vue';

export default {
    components: {
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
