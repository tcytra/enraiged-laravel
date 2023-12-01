<template>
    <div class="control filter dropdown">
        <label v-if="field.label" class="label" :for="id">
            {{ label }}
        </label>
        <primevue-dropdown class="w-full" optionLabel="name" optionValue="id"
            v-model="form[id]"
            :disabled="field.disabled"
            :filter="field.searchable"
            :id="id"
            :loading="loading"
            :options="options"
            :placeholder="field.placeholder"
            :show-clear="field.clearable"
            @filter="filter"
            @update:modelValue="$emit('update:filterValue', $event)">
            <template #option="props">
                <span :class="props.option.class">{{ props.option.name }}</span>
            </template>
        </primevue-dropdown>
    </div>
</template>

<script>
import PrimevueDropdown from 'primevue/dropdown/Dropdown.vue';

export default {
    inheritAttrs: false,

    components: {
        PrimevueDropdown,
    },

    props: {
        field: {
            type: Object,
            required: true,
        },
        form: {
            type: Object,
            required: true,
        },
        id: {
            type: String,
            required: true,
        },
    },

    data: () => ({
        options: [],
        limit: null,
        loading: false,
        search: null,
        timer: null,
    }),

    mounted() {
        if (this.field.options.source === 'api') {
            if (this.field.options.limit) {
                this.limit = this.field.options.limit;
            }
            this.fetch();
        } else {
            this.options = this.field.options.values;
        }
    },

    methods: {
        fetch() {
            this.loading = true;
            return this.axios.get(this.field.options.uri, { params: this.params() })
                .then(({ data }) => {
                    this.options = data;
                    this.loading = false;
                })
                .catch(error => this.errorHandler(error));
        },
        filter(payload) {
            this.field.options.values = [];
            this.search = payload.value;
        },
        params() {
            let params = {};
            if (typeof this.field.options.params !== 'undefined') {
                this.field.options.params.forEach((param) => {
                    params[param] = this.form[param];
                });
            }
            return {
                ...this.field.options.filters,
                ...params,
                limit: this.limit,
                search: this.search,
            };
        },
    },

    watch: {
        search: {
            handler(value) {
                clearTimeout(this.timer);
                this.timer = setTimeout(this.fetch, 500);
            }
        },
    },
};
</script>
