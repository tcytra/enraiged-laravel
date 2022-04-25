<template>
    <vue-form-field v-slot:default="{ error, label, placeholder, update }"
        :field="field"
        :form="form"
        :id="id">
        <div class="control text" :class="$attrs.class">
            <label v-if="label" class="label" :for="id">
                {{ label }}
            </label>
            <div class="field text">
                <primevue-calendar
                    v-model="model"
                    :class="{ 'p-inputtext-lg': isLarge, 'p-inputtext-sm': isSmall, 'p-invalid': error }"
                    :date-format="field.date_format || 'yy-mm-dd'"
                    :id="id"
                    :placeholder="placeholder"
                    @update:modelValue="update"/>
            </div>
            <div class="error" v-if="error">
                {{ error }}
            </div>
        </div>
    </vue-form-field>
</template>

<script>
import { v4 as uuid } from 'uuid';
import PrimevueCalendar from 'primevue/calendar';
import VueFormField from '@/components/forms/VueFormField';

export default {
    inheritAttrs: false,

    components: {
        PrimevueCalendar,
        VueFormField,
    },

    props: {
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
    },

    computed: {
        model() {
            return this.form ? this.form[this.id] : null;
        },
    },
};
</script>
