<template>
    <headless-form-field v-slot:default="{ error, isDirty, isDisabled, isHidden, label, placeholder, update }"
        v-bind="$props">
        <div class="col-12 line-break" v-if="field.break"><hr class=""></div>
        <div :class="field.before" v-if="field.before"/>
        <div class="control field dropdown" v-show="show && !isHidden"
            :class="[$attrs.class, field.class]">
            <label v-if="label" class="label" :for="id">
                {{ label }}
            </label>
            <primevue-dropdown class="w-full" optionLabel="name" optionValue="id"
                v-model="form[id]"
                :class="{
                    'is-creating': isDirty && creating,
                    'is-updating': isDirty && updating,
                    'p-inputtext-lg': isLarge,
                    'p-inputtext-sm': isSmall,
                    'p-invalid': error,
                }"
                :disabled="loading || isDisabled"
                :filter="field.searchable || searchable"
                :id="id"
                :loading=loading
                :options="options"
                :placeholder="placeholder"
                :show-clear="field.clearable || clearable"
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
import PrimevueTooltip from 'primevue/tooltip/tooltip.esm.js';

export default {
    inheritAttrs: false,

    components: {
        HeadlessFormField,
        PrimevueDropdown,
    },

    directives: {
        tooltip: PrimevueTooltip,
    },

    inject: ['errorHandler'],

    props: {
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
        field: {
            type: Object,
            required: true,
        },
        filterable: {
            type: Boolean,
            default: false,
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
        clear() {
            const value = typeof this.field.default !== 'undefined'
                ? this.field.default
                : null;
            this.form[this.id] = value;
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
            const url = this.field.options.uri;
            this.axios[method](url, data)
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
