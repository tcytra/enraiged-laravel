<template>
    <div class="control filter dropdown">
        <label v-if="field.label" class="label" :for="id">
            {{ i18n(label) }}
        </label>
        <primevue-multi-select class="w-full" optionLabel="name" optionValue="id" v-if="field.multiple"
            v-model="form[id]"
            :disabled="field.disabled"
            :filter="field.searchable"
            :id="id"
            :loading="loading"
            :options="options"
            :placeholder="i18n(field.placeholder)"
            :show-clear="field.clearable"
            @filter="filter"
            @update:modelValue="$emit('update:filterValue', $event)">
            <template #option="props">
                <span :class="props.option.class">{{ i18n(props.option.name) }}</span>
            </template>
        </primevue-multi-select>
        <primevue-dropdown class="w-full" optionLabel="name" optionValue="id" v-else
            v-model="form[id]"
            :disabled="field.disabled"
            :filter="field.searchable"
            :id="id"
            :loading="loading"
            :options="options"
            :placeholder="i18n(field.placeholder)"
            :show-clear="field.clearable"
            @filter="filter"
            @update:modelValue="$emit('update:filterValue', $event)">
            <template #option="props">
                <span :class="props.option.class">{{ i18n(props.option.name) }}</span>
            </template>
        </primevue-dropdown>
    </div>
</template>

<script>
import PrimevueDropdown from 'primevue/dropdown/Dropdown.vue';
import PrimevueMultiSelect from 'primevue/multiselect/MultiSelect.vue';

export default {
    inheritAttrs: false,

    components: {
        PrimevueDropdown,
        PrimevueMultiSelect,
    },

    inject: ['i18n'],

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
        autoselect() {
            const autoselect = typeof this.field.autoselect !== 'undefined' && this.field.autoselect === true;
            if (autoselect && this.options.length === 1) {
                this.form[this.id] = this.options[0].id;
                this.$emit('update:modelValue', this.options[0].id)
            }
        },
        fetch() {
            this.loading = true;
            return this.axios.get(this.field.options.uri, { params: this.params() })
                .then(({ data }) => {
                    this.options = data;
                    this.loading = false;
                    this.autoselect();
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
