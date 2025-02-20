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
            <primevue-upload mode="basic" name="upload[]"
                :accept="usingAcceptFile"
                :choose-label="usingChooseLabel"
                :disabled="isDisabled"
                :multiple="enableMultiple"
                @select="onSelectedFiles"/>
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
import PrimevueTooltip from 'primevue/tooltip';
import PrimevueUpload from 'primevue/fileupload';

export default {
    inheritAttrs: false,

    components: {
        HeadlessFormField,
        PrimevueUpload,
    },

    directives: {
        tooltip: PrimevueTooltip,
    },

    inject: ['errorHandler', 'i18n'],

    props: {
        acceptFile: {
            type: String,
            default: null,
        },
        chooseLabel: {
            type: String,
            default: null,
        },
        creating: {
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
        show: {
            type: Boolean,
            default: true,
        },
        updating: {
            type: Boolean,
            default: false,
        },
    },

    computed: {
        enableAutoUpload() {
            return this.autoupload === true
                || this.field.autoupload === true;
        },
        enableMultiple() {
            return this.multiple === true
                || this.field.multiple === true;
        },
        usingAcceptFile() {
            return this.acceptFile
                || this.field.acceptfile
                || null;
        },
        usingChooseLabel() {
            return this.chooseLabel
                || this.field.chooselabel
                || 'Browse';
        },
    },

    methods: {
        onSelectedFiles(payload) {
            this.form.upload_file = this.enableMultiple
                ? payload.files
                : payload.files[0];
        },
    },
};
</script>
