<template>
    <headless-form-field v-slot:default="{ error, isDirty, isDisabled, isHidden, label, placeholder }"
        v-bind="$props">
        <div class="control filter daterange" v-if="!isHidden">
            <label v-if="field.label" class="label" :for="id">
                {{ i18n(label) }}
            </label>
            <div class="p-inputgroup">
                <primevue-calendar class="w-full" selectionMode="range" ref="daterange" size="small"
                    v-model="model"
                    :date-format="field.format || 'yy-mm-dd'"
                    :disabled="isDisabled"
                    :id="id"
                    :manualInput="false"
                    :maxDate="maxDate"
                    :minDate="minDate"
                    :numberOfMonths="2"
                    :placeholder="i18n(placeholder)"
                    :showIcon="showIcon"
                    :touchUI="isMobile || isTablet"
                    @update:modelValue="update"/>
                <primevue-button icon="pi pi-times" class="p-button-secondary"
                    :disabled="!model"
                    @click="clear()"/>
            </div>
        </div>
    </headless-form-field>
</template>

<script>
import { format as dateFnsFormat } from 'date-fns';
import HeadlessFormField from '@/components/forms/headless/FormField.vue';
import PrimevueButton from 'primevue/button';
import PrimevueCalendar from 'primevue/calendar';

export default {
    inheritAttrs: false,

    components: {
        HeadlessFormField,
        PrimevueButton,
        PrimevueCalendar,
    },

    inject: ['intl', 'app'],

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
            return this.intl.i18n;
        },
        isMobile() {
            return app.meta.mobile;
        },
        isTablet() {
            return app.meta.tablet;
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
        showIcon() {
            return this.field.showIcon || false;
        },
    },

    beforeMount() {
        const form = this.form[this.id];
        if (typeof form !== 'undefined' && form !== null) {
            this.model = [this.newDate(form[0]), this.newDate(form[1])];
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
            this.form[this.id] = this.model[1] !== null
                ? [this.formatDate(this.model[0]), this.formatDate(this.model[1])]
                : null;
            if (this.model[1] !== null) {
                this.$refs.daterange.overlayVisible = false;
                this.$emit('update:filterValue', this.form[this.id]);
            }
        },
    },
};
</script>
