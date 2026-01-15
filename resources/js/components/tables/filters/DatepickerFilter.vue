<template>
    <form-field v-slot:default="{ error, isDirty, isDisabled, isHidden, label, placeholder }"
        v-bind="$props">
        <div class="control filter datepicker" v-if="!isHidden">
            <label v-if="field.label" class="label" :for="id">
                {{ i18n(label) }}
            </label>
            <primevue-datepicker class="w-full" iconDisplay="input" ref="datepicker" size="small"
                v-model="model"
                :date-format="field.format || 'yy-mm-dd'"
                :disabled="isDisabled"
                :id="id"
                :manualInput="false"
                :maxDate="maxDate"
                :minDate="minDate"
                :placeholder="i18n(placeholder)"
                :showClear="showClear"
                :showIcon="showIcon"
                :touchUI="isMobile || isTablet"
                @update:modelValue="update" />
        </div>
    </form-field>
</template>

<script>
import { format as dateFnsFormat } from 'date-fns';
import { trans as i18n } from 'laravel-vue-i18n';
import FormField from '@/components/forms/fields/renderless/FormField.vue';
import PrimevueButton from 'primevue/button';
import PrimevueDatepicker from 'primevue/datepicker';

export default {
    inheritAttrs: false,

    components: {
        FormField,
        PrimevueButton,
        PrimevueDatepicker,
    },

    inject: ['app'],

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
        model: null,
    }),

    computed: {
        i18n() {
            return i18n;
        },
        isMobile() {
            return this.app.meta.value.agent.mobile;
        },
        isTablet() {
            return this.app.meta.value.agent.tablet;
        },
        maxDate() {
            return this.field.maximum
                ? this.newDate(this.field.maximum)
                : null;
        },
        minDate() {
            return this.field.minimum
                ? this.newDate(this.field.minimum)
                : null;
        },
        showClear() {
            return this.field.showClear || false;
        },
        showIcon() {
            return this.field.showIcon || false;
        },
    },

    beforeMount() {
        const form = this.form[this.id];
        if (typeof form !== 'undefined' && form !== null) {
            this.model = this.newDate(form);
        }
    },

    methods: {
        clear() {
            this.form[this.id] = null;
            this.model = null;
            this.$emit('update:filterValue', this.form[this.id]);
        },
        formatDate(value) {
            return dateFnsFormat(value, 'yyyy-MM-dd');
        },
        newDate(date) {
            return new Date(`${date} 00:00:00`);
        },
        update() {
            this.form[this.id] = this.model
                ? this.formatDate(this.model)
                : null;
            if (this.model !== null) {
                this.$refs.datepicker.overlayVisible = false;
                this.$emit('update:filterValue', this.form[this.id]);
            }
        },
    },
};
</script>
