<template>
    <headless-form-field v-slot:default="{ error, isDirty, isDisabled, isHidden, label, placeholder, update }"
        v-bind="$props">
        <div class="col-12 line-break" v-if="field.break">
            <hr :class="field.break" v-if="typeof field.break === 'string'">
            <hr v-else>
        </div>
        <div :class="field.before" v-if="field.before"/>
        <div class="control field dropdown" v-show="show && !isHidden"
            :class="[$attrs.class, field.class]">
            <label v-if="label" class="label" :for="id">
                {{ label }}
            </label>
            <primevue-multi-select class="w-full" v-if="enableMultiple"
                v-model="form[id]"
                :class="{
                    'is-creating': isDirty && creating,
                    'is-updating': isDirty && updating,
                    'p-inputtext-lg': isLarge,
                    'p-inputtext-sm': isSmall,
                    'p-invalid': invalid || error,
                }"
                :disabled="loading || isDisabled || (disableIfNoOptions && !options.length)"
                :filter="enableFilter"
                :id="id"
                :loading=loading
                :options="options"
                :option-label="usingOptionLabel"
                :option-value="usingOptionValue"
                :placeholder="placeholder"
                :show-clear="enableShowClear"
                @filter="filter"
                @update:modelValue="update(); $emit('update:modelValue', $event)">
                <template #option="props">
                    <span :class="props.option.class">{{ props.option.name }}</span>
                </template>
            </primevue-multi-select>
            <primevue-dropdown class="w-full" v-else
                v-model="form[id]"
                :class="{
                    'is-creating': isDirty && creating,
                    'is-updating': isDirty && updating,
                    'p-inputtext-lg': isLarge,
                    'p-inputtext-sm': isSmall,
                    'p-invalid': invalid || error,
                }"
                :disabled="loading || isDisabled || (disableIfNoOptions && !options.length)"
                :filter="enableFilter"
                :id="id"
                :loading=loading
                :options="options"
                :option-label="usingOptionLabel"
                :option-value="usingOptionValue"
                :placeholder="placeholder"
                :show-clear="enableShowClear"
                @filter="filter"
                @update:modelValue="update(); $emit('update:modelValue', $event)">
                <template #option="props">
                    <span :class="props.option.class">{{ props.option.name }}</span>
                </template>
            </primevue-dropdown>
            <div class="error p-error" v-if="error">
                <i class="pi pi-exclamation-circle" v-tooltip.top="error"></i>
                <span class="message">{{ error }}</span>
            </div>
        </div>
        <div :class="field.after" v-if="field.after"/>
    </headless-form-field>
</template>

<script>
import HeadlessFormField from '@/components/forms/headless/FormField.vue';
import PrimevueDropdown from 'primevue/dropdown/Dropdown.vue';
import PrimevueMultiSelect from 'primevue/multiselect/MultiSelect.vue';
import PrimevueTooltip from 'primevue/tooltip/tooltip.esm.js';

export default {
    inheritAttrs: false,

    components: {
        HeadlessFormField,
        PrimevueDropdown,
        PrimevueMultiSelect,
    },

    directives: {
        tooltip: PrimevueTooltip,
    },

    inject: ['errorHandler'],

    props: {
        autoselectable: {
            type: Boolean,
            default: false,
        },
        clearable: {
            type: Boolean,
            default: false,
        },
        creating: {
            type: Boolean,
            default: false,
        },
        disabled: {
            type: Boolean,
            default: false,
        },
        disableIfNoOptions: {
            type: Boolean,
            default: false,
        },
        field: {
            type: Object,
            required: true,
        },
        focus: {
            type: Boolean,
            default: false,
        },
        form: {
            type: Object,
            required: true,
        },
        id: {
            type: String,
            required: true,
        },
        isLarge: {
            type: Boolean,
            default: false,
        },
        isSmall: {
            type: Boolean,
            default: false,
        },
        invalid: {
            type: Boolean,
            default: false,
        },
        multiple: {
            type: Boolean,
            default: false,
        },
        optionLabel: {
            type: String,
            default: null,
        },
        optionValue: {
            type: String,
            default: null,
        },
        searchable: {
            type: Boolean,
            default: false,
        },
        show: {
            type: Boolean,
            default: true,
        },
        updating: {
            type: Boolean,
            default: false,
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
        enableAutoSelectable() {
            return this.autoselectable === true
                || this.field.autoselectable === true;
        },
        enableFilter() {
            return this.searchable === true
                || this.field.searchable === true;
        },
        enableMultiple() {
            return this.multiple === true
                || this.field.multiple === true;
        },
        enableShowClear() {
            return this.clearable === true
                || this.field.clearable === true;
        },
        selectedOption() {
            if (Object.keys(this.form.data()).includes(this.id)) {
                const option = this.options
                    .filter((each) => each.id === this.form[this.id]);
                if (option.length) {
                    return option[0];
                }
            }

            return null;
        },
        usingOptionLabel() {
            return this.optionLabel
                || this.field.options.label
                || 'name';
        },
        usingOptionValue() {
            return this.optionValue
                || this.field.options.value
                || 'id';
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
            this.autoselect();
        }
    },

    methods: {
        autoselect() {
            if (this.enableAutoSelectable && this.options.length === 1) {
                this.form[this.id] = this.options[0].id;
                this.$emit('update:modelValue', this.options[0].id)
            }
        },
        clear() {
            const value = typeof this.field.default !== 'undefined'
                ? this.field.default
                : null;
            this.form[this.id] = value;
        },
        clearAll() {
            this.clear();
            this.options = [];
            this.search = null;
            this.timer = null;
        },
        data() {
            let params = {};
            if (typeof this.field.options.params !== 'undefined') {
                this.field.options.params.forEach((param) => {
                    params[param] = this.form[param];
                });
            }
            if (typeof this.params === 'object' && Object.keys(this.params).length) {
                params = { ...params, ...this.params };
            }
            return {
                ...this.field.options.filters,
                ...params,
                limit: this.limit,
                search: this.search,
            };
        },
        fetch() {
            this.loading = true;
            this.options = [];
            const method = this.field.options.method || 'get';
            const data = method === 'get'
                ? { params: this.data() }
                : this.data();
            const url = this.field.options.uri + (this.field.options.strict ? '/strict' : '');
            this.axios[method](url, data)
                .then(({ data }) => {
                    this.options = data;
                    this.loading = false;
                    this.$emit('options:fetched', data.length);
                    this.autoselect();
                })
                .catch(error => this.errorHandler(error));
        },
        filter(payload) {
            if (this.field.options.source) {
                this.field.options.values = [];
                this.search = payload.value;
            }
        },
    },

    watch: {
        search: {
            handler() {
                clearTimeout(this.timer);
                this.timer = setTimeout(this.fetch, 500);
            }
        },
    },
};
</script>
