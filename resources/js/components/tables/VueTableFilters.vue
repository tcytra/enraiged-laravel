<template>
    <div class="grid m-0">
        <div class="filter" v-for="(field, name) in filters"
            :class="filterClassName(field)"
            :key="name">
            <daterange-filter v-if="field.type === 'daterange'" :ref="filterRefName(name)"
                :field="field"
                :form="form"
                :id="name"
                @update:filterValue="filter(name)"/>
            <dropdown-filter v-if="field.type === 'select'" :ref="filterRefName(name)"
                :field="field"
                :form="form"
                :id="name"
                @update:filterValue="filter(name)"/>
        </div>
    </div>
</template>

<script>
import DaterangeFilter from './filters/DaterangeFilter.vue';
import DropdownFilter from './filters/DropdownFilter.vue';

export default {
    components: {
        DaterangeFilter,
        DropdownFilter,
    },

    props: {
        filter: {
            type: Function,
            required: true,
        },
        filters: {
            type: Object,
            required: true,
        },
        form: {
            type: Object,
            required: true,
        },
    },

    methods: {
        filterClassName(filter) {
            return filter.class
                || 'col-12 md:col-4 lg:col-3 xl:col-2';
        },
        filterRefName(name) {
            return `${name}_filter`
                .replace(/([_][a-z])/g, (group) => group
                    .toUpperCase()
                    .replace('_', ''));
        },
    },
};
</script>
