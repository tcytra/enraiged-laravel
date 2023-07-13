<template>
    <div class="control filter daterange">
        <label v-if="field.label" class="label" :for="id">
            {{ label }}
        </label>
        <div class="p-inputgroup">
            <primevue-calendar class="w-full" selectionMode="range" ref="calendar"
                v-model="model"
                :date-format="field.format || 'yy-mm-dd'"
                :disabled="field.disabled"
                :id="id"
                :manualInput="false"
                :maxDate="maxDate"
                :minDate="minDate"
                :numberOfMonths="2"
                :placeholder="field.placeholder"
                :showIcon="showIcon"
                :touchUI="isMobile || isTablet"
                @update:modelValue="update" />
            <primevue-button icon="pi pi-times" class="p-button-secondary"
                :disabled="!model"
                @click="clear()"/>
        </div>
    </div>
</template>

<script>
import { format as dateFnsFormat } from 'date-fns';
import PrimevueButton from 'primevue/button/Button.vue';
import PrimevueCalendar from 'primevue/calendar/Calendar.vue';

export default {
    inheritAttrs: false,

    components: {
        PrimevueButton,
        PrimevueCalendar,
    },

    inject: ['isMobile', 'isTablet'],

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
                this.$refs.calendar.overlayVisible = false;
                this.$emit('update:filterValue', this.form[this.id]);
            }
        },
    },
};
</script>
