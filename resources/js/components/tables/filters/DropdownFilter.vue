<template>
    <form-field v-slot:default="{ error, isDirty, isDisabled, isHidden, label, placeholder }"
        v-bind="$props">
        <div class="control filter dropdown" v-if="!isHidden">
            <label v-if="field.label" class="label" :for="id">
                {{ i18n(label) }}
            </label>
            <primevue-multi-select class="w-full" optionLabel="name" optionValue="id" size="small" v-if="field.multiple"
                v-model="form[id]"
                :disabled="isDisabled"
                :filter="field.searchable"
                :id="id"
                :loading="loading"
                :options="options"
                :placeholder="i18n(placeholder)"
                :show-clear="field.clearable"
                @filter="filter"
                @update:modelValue="$emit('update:filterValue', $event)">
                <template #option="props">
                    <span :class="props.option.class">{{ i18n(props.option.name) }}</span>
                </template>
            </primevue-multi-select>
            <primevue-select class="w-full" optionLabel="name" optionValue="id" size="small" v-else
                v-model="form[id]"
                :disabled="isDisabled"
                :filter="field.searchable"
                :id="id"
                :loading="loading"
                :options="options"
                :placeholder="i18n(placeholder)"
                :show-clear="field.clearable"
                @filter="filter"
                @update:modelValue="$emit('update:filterValue', $event)">
                <template #option="props">
                    <span :class="props.option.class">{{ i18n(props.option.name) }}</span>
                </template>
            </primevue-select>
        </div>
    </form-field>
</template>

<script>
import { trans as i18n } from 'laravel-vue-i18n';
import FormField from '@/components/forms/fields/renderless/FormField.vue';
import PrimevueMultiSelect from 'primevue/multiselect';
import PrimevueSelect from 'primevue/select';

export default {
    inheritAttrs: false,

    components: {
        FormField,
        PrimevueMultiSelect,
        PrimevueSelect,
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

    computed: {
        i18n() {
            return i18n;
        },
    },

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
            return axios.get(this.field.options.uri, { params: this.params() })
                .then(({ data }) => {
                    this.options = data;
                    this.loading = false;
                    this.autoselect();
                })
                .catch((e) => this.error(e));
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
