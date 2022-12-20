<template>
    <headless-form-field v-slot:default="{ dirty, disabled, error, label, placeholder, update }"
        v-bind="$props">
        <div :class="field.before" v-if="field.before"/>
        <div class="control field dropdown" v-show="show"
            :class="[$attrs.class, field.class, labels]">
            <label v-if="label" class="label" :for="id">
                {{ label }}
            </label>
            <primevue-dropdown class="w-full" optionLabel="name" optionValue="id"
                v-model="form[id]"
                :class="{
                    'is-creating': dirty && creating,
                    'is-updating': dirty && updating,
                    'p-inputtext-lg': isLarge,
                    'p-inputtext-sm': isSmall,
                    'p-invalid': form.errors[id],
                }"
                :disabled="loading || disabled"
                :filter="field.searchable || searchable"
                :id="id"
                :loading=loading
                :options="options"
                :placeholder="placeholder"
                :show-clear="field.clearable || clearable"
                @filter="filter"
                @update:modelValue="update"/>
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
import PrimevueDropdown from 'primevue/dropdown';
import PrimevueTooltip from 'primevue/tooltip';

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
        labels: {
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
            return {
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
