<template>
    <form-field :field="field" :form="form" :id="id" v-slot:default="field">
        <div class="col-12 line-break" v-if="field.break">
            <hr :class="field.break" v-if="typeof field.break === 'string'">
            <hr v-else>
        </div>
        <div :class="field.before" v-if="field.before" />
        <div class="control field" v-show="!field.isHidden"
            :class="[$attrs.class, field.class, field.type]">
            <slot name="label" v-bind="field">
                <label class="label" ref="label" :for="field.id" v-if="field.label" @click="focus">
                    {{ field.label }}
                </label>
            </slot>
            <slot name="field" v-bind="field">
                <primevue-multiselect class="dropdown input multi primevue" ref="input" v-if="enableMultiple"
                    v-model="field.form[field.id]"
                    :class="[{
                        'has-error': field.error,
                        'is-creating': field.isCreating,
                        'is-updating': field.isUpdating,
                    }, field.width]"
                    :disabled="loading || field.isDisabled || (disableIfNoOptions && !options.length)"
                    :filter="enableSearchable"
                    :input-id="field.id"
                    :invalid="!!field.error"
                    :loading="loading"
                    :option-label="enableOptionLabel"
                    :option-value="enableOptionValue"
                    :options="options"
                    :placeholder="field.placeholder"
                    :show-clear="enableClearable"
                    :size="field.size"
                    @filter="filter"
                    @update:modelValue="field.update($event)">
                    <template #dropdownicon="props">
                        <slot name="dropdownicon" v-bind="props" />
                    </template>
                    <template #filtericon="props">
                        <slot name="filtericon" v-bind="props" />
                    </template>
                    <template #footer>
                        <slot name="footer" v-bind="props">
                            <div :class="field.footer.class" v-if="field.footer && field.footer.class">
                                {{ i18n(field.footer.text) }}
                            </div>
                            <div class="font-medium p-3" v-else-if="field.footer">
                                {{ i18n(field.footer) }}
                            </div>
                        </slot>
                    </template>
                    <template #header>
                        <slot name="header" v-bind="props">
                            <div :class="field.header.class" v-if="field.header && field.header.class">
                                {{ i18n(field.header.text) }}
                            </div>
                            <div class="font-medium p-3" v-else-if="field.header">
                                {{ i18n(field.header) }}
                            </div>
                        </slot>
                    </template>
                    <template #option="props">
                        <slot name="option" v-bind="props" />
                    </template>
                </primevue-multiselect>
                <primevue-select class="dropdown input primevue" ref="input" v-else
                    v-model="field.form[field.id]"
                    :class="[{
                        'has-error': field.error,
                        'is-creating': field.isCreating,
                        'is-updating': field.isUpdating,
                    }, field.inputWidth]"
                    :disabled="loading || field.isDisabled || (disableIfNoOptions && !options.length)"
                    :filter="enableSearchable"
                    :input-id="field.id"
                    :invalid="!!field.error"
                    :loading="loading"
                    :option-label="enableOptionLabel"
                    :option-value="enableOptionValue"
                    :options="options"
                    :placeholder="field.placeholder"
                    :show-clear="enableClearable"
                    :size="field.size"
                    @filter="filter"
                    @update:modelValue="field.update($event)">
                    <template #dropdownicon="props">
                        <slot name="dropdownicon" v-bind="props" />
                    </template>
                    <template #filtericon>
                        <slot name="filtericon" v-bind="props" />
                    </template>
                    <template #footer>
                        <slot name="footer" v-bind="props">
                            <div :class="field.footer.class" v-if="field.footer && field.footer.class">
                                {{ i18n(field.footer.text) }}
                            </div>
                            <div class="font-medium p-3" v-else-if="field.footer">
                                {{ i18n(field.footer) }}
                            </div>
                        </slot>
                    </template>
                    <template #header>
                        <slot name="header" v-bind="props">
                            <div :class="field.header.class" v-if="field.header && field.header.class">
                                {{ i18n(field.header.text) }}
                            </div>
                            <div class="font-medium p-3" v-else-if="field.header">
                                {{ i18n(field.header) }}
                            </div>
                        </slot>
                    </template>
                    <template #option="props">
                        <slot name="option" v-bind="props" />
                    </template>
                    <template #value="props">
                        <slot name="value" v-bind="props" />
                    </template>
                </primevue-select>
            </slot>
            <div class="error" v-if="field.error">
                <span class="message">{{ field.error }}</span>
            </div>
        </div>
        <div :class="field.after" v-if="field.after" />
    </form-field>
</template>

<script setup>
import { computed, onMounted, reactive, ref, useTemplateRef, watch } from 'vue';
import { useHandlers } from '@/handlers';
import FormField from './renderless/FormField.vue';
import PrimevueMultiselect from 'primevue/multiselect';
import PrimevueSelect from 'primevue/select';

const { error, i18n } = useHandlers();
const emit = defineEmits(['options:fetched', 'update:modelValue']);
const input = useTemplateRef('input');
const options = reactive([]);
const loading = ref(false);
const search = ref(null);
const timer = ref(null);

const props = defineProps({
    autofocus: {
        type: Boolean,
        default: false,
    },
    autoselect: {
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
    form: {
        type: Object,
        required: true,
    },
    id: {
        type: String,
        required: true,
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
});

const autoselectSingleOption = () => {
    if (enableAutoSelect && options.length === 1) {
        props.form[props.id] = options[0].id;
        emit('update:modelValue', this.options[0].id);
    }
};

const clearOptions = () => {
    options.splice(0, options.length);
};

const data = (limit) => {
    let params = {};
    if (typeof props.field.options.params !== 'undefined') {
        const fieldParams = typeof props.field.options.params !== 'object'
            ? [props.field.options.params]
            : props.field.options.params;
        fieldParams.forEach((param) => {
            params[param] = props.form[param];
        });
    }
    if (props.field.options.strict) {
        params.strict = props.field.options.strict;
    }
    //if (typeof this.params === 'object' && Object.keys(this.params).length) {
    //    params = { ...params, ...this.params };
    //}
    return {
        ...props.field.options.filters,
        ...params,
        limit: limit,
        search: search.value,
    };
};

const fetch = (limit) => {
    loading.value = true;
    clearOptions();
    const method = props.field.options.method || 'get';
    const params = method === 'get' ? { params: data(limit) } : data(limit);
    let url = route().has(props.field.options.route)
        ? route(props.field.options.route, props.form.data())
        : props.field.options.uri || null;
    if (url) {
        url = new URL(url);
        url.search = '';
        axios[method](url.toString(), params)
            .then(({ data }) => {
                options.push(...data);
                loading.value = false;
                emit('options:fetched', data.length);
                autoselectSingleOption();
            })
            .catch((e) => error(e));
    }
};

const filter = (payload) => {
    if (props.field.options.source) {
        search.value = payload.value;
    }
};

const selected = () => {
    if (Object.keys(props.form.data()).includes(props.id)) {
        const option = options
            .filter((each) => each.id === props.form[props.id]);
        if (option.length) {
            return option[0];
        }
    }
    return null;
};

const focus = () => {
    input.value.$el.click();
};

const enableAutoSelect = computed(() => props.autoselect === true || props.field.autoselect === true);
const enableClearable = computed(() => props.clearable === true || props.field.clearable === true);
const enableMultiple = computed(() => props.multiple === true || props.field.multiple === true
    || props.field.type === 'multiselect');
const enableOptionLabel = computed(() => props.optionLabel || props.field.options?.label || 'name');
const enableOptionValue = computed(() => props.optionValue || props.field.options?.value || 'id');
const enableSearchable = computed(() => props.searchable === true || props.field.searchable === true);
const selectedOption = computed(() => selected());

defineExpose({
    fetch,
    loading,
    options,
    search,
    selected: selectedOption,
});

onMounted(() => {
    if (props.autofocus === true || props.field.autofocus === true) {
        input.value.$el.click();
    }
    if (props.field.options.source === 'api') {
        const limit = props.field.options.limit || null;
        fetch(limit);
    } else
    if (Array.isArray(props.field.options?.values)) {
        options.push(...props.field.options.values);
        autoselectSingleOption();
    }
});

watch(search, async () => {
    loading.value = true;
    clearTimeout(timer.value);
    timer.value = setTimeout(fetch, 200);
});
</script>
