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
            <div class="flex w-full">
                <primevue-dropdown class="flex-grow-1" optionLabel="name" optionValue="id"
                    v-model="form[id]"
                    :class="{
                        'is-creating': isDirty && creating,
                        'is-updating': isDirty && updating,
                        'p-inputtext-lg': isLarge,
                        'p-inputtext-sm': isSmall,
                        'p-invalid': error,
                    }"
                    :disabled="isDisabled"
                    :id="id"
                    :options="options"
                    :placeholder="placeholder"
                    @update:modelValue="update(); $emit('update:modelValue', $event)">
                    <template #option="props">
                        <span :class="props.option.class">{{ props.option.name }}</span>
                    </template>
                </primevue-dropdown>
                <primevue-button class="ml-1" icon="pi pi-eye"
                    v-if="!viewing"
                    v-tooltip.top="i18n('Preview this theme')"
                    :disabled="!isDirty"
                    @click="preview"/>
                <primevue-button class="p-button-danger ml-1" icon="pi pi-times"
                    v-if="viewing"
                    v-tooltip.top="i18n('I don\'t like it!')"
                    @click="reset"/>
                <!--
                <primevue-button class="p-button-success ml-1" icon="pi pi-check"
                    v-tooltip.top="i18n('I like it!')"
                    :disabled="!viewing"
                    @click="save"/>
                -->
            </div>
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
import PrimevueButton from 'primevue/button/Button.vue';
import PrimevueDropdown from 'primevue/dropdown/Dropdown.vue';
import PrimevueTooltip from 'primevue/tooltip/tooltip.esm.js';

export default {
    inheritAttrs: false,

    components: {
        HeadlessFormField,
        PrimevueButton,
        PrimevueDropdown,
    },

    directives: {
        tooltip: PrimevueTooltip,
    },

    inject: ['errorHandler', 'i18n', 'user'],

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
        viewing: null,
    }),

    computed: {
        myTheme() {
            return this.user && this.user.id === this.id;
        },
    },

    mounted() {
        this.options = this.field.options.values;
        if (this.field.value !== this.form[this.id]) {
            this.viewing = this.form[this.id];
        }
    },

    methods: {
        preview() {
            this.$primevue.changeTheme(this.field.value, this.form[this.id], 'theme-color', () => {});
            this.viewing = this.form[this.id];
        },
        reset() {
            this.$primevue.changeTheme(this.viewing, this.field.value, 'theme-color', () => {});
            this.form[this.id] = this.field.value;
            this.viewing = null;
        },
        save() {
            //
        },
    },
};
</script>
