<template>
    <form-field v-slot:default="{ error, isDirty, isDisabled, isHidden, label, placeholder }"
        v-bind="$props">
        <div class="control filter togglebutton min-w-[128px]" @click="update" v-if="!isHidden"
            :class="{ 'toggled': value }">
            <primevue-inputgroup>
                <primevue-inputgroup-addon>
                    <i class="pi pi-check text-sm" v-if="value"></i>
                </primevue-inputgroup-addon>
                <label class="p-label">
                    <span class="" v-if="value">{{ i18n(field.label) }}</span>
                    <span class="" v-else>{{ i18n(field.labelOff) }}</span>
                </label>
            </primevue-inputgroup>
        </div>
    </form-field>
</template>

<script>
import { format as dateFnsFormat } from 'date-fns';
import { trans as i18n } from 'laravel-vue-i18n';
import FormField from '@/components/forms/fields/renderless/FormField.vue';
import PrimevueButton from 'primevue/button';
import PrimevueCheckbox from 'primevue/checkbox';
import PrimevueInputgroup from 'primevue/inputgroup';
import PrimevueInputgroupAddon from 'primevue/inputgroupaddon';

export default {
    inheritAttrs: false,

    components: {
        FormField,
        PrimevueButton,
        PrimevueCheckbox,
        PrimevueInputgroup,
        PrimevueInputgroupAddon,
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

    computed: {
        i18n() {
            return i18n;
        },
        value() {
            return this.form[this.id];
        },
    },

    methods: {
        update() {
            this.form[this.id] = !this.form[this.id];
            this.$emit('update:filterValue', this.value);
        },
    },
};
</script>
