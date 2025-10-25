<template>
    <div class="bar filter flex flex-row gap-2">
        <div class="filter" v-for="(field, name) in filters"
            :class="field.class"
            :key="name">
            <datepicker-filter v-if="field.type === 'datepicker'" :ref="filterRefName(name)"
                :field="field"
                :form="form"
                :id="name"
                @update:filterValue="filter(name)" />
            <daterange-filter v-if="field.type === 'daterange'" :ref="filterRefName(name)"
                :field="field"
                :form="form"
                :id="name"
                @update:filterValue="filter(name)" />
            <dropdown-filter v-if="field.type === 'select'" :ref="filterRefName(name)"
                :field="field"
                :form="form"
                :id="name"
                @update:filterValue="filter(name)" />
            <toggle-filter v-if="field.type === 'toggle'" :ref="filterRefName(name)"
                :field="field"
                :form="form"
                :id="name"
                @update:filterValue="filter(name)" />
        </div>
    </div>
</template>

<script>
import DatepickerFilter from './filters/DatepickerFilter.vue';
import DaterangeFilter from './filters/DaterangeFilter.vue';
import DropdownFilter from './filters/DropdownFilter.vue';
import ToggleFilter from './filters/ToggleFilter.vue';

export default {
    components: {
        DatepickerFilter,
        DaterangeFilter,
        DropdownFilter,
        ToggleFilter,
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
        filterRefName(name) {
            return `${name}_filter`
                .replace(/([_][a-z])/g, (group) => group
                    .toUpperCase()
                    .replace('_', ''));
        },
    },
};
</script>
