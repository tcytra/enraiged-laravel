<template>
    <form-field :field="field" :form="form" :id="id" v-slot:default="field">
        <line-break :field="field" v-if="field.break" />
        <div :class="field.before" v-if="field.before" />
        <div class="control field" v-show="!field.isHidden"
            :class="[$attrs.class, field.class, field.type]">
            <slot name="label" v-bind="field">
                <field-label :field="field" v-if="field.label" />
            </slot>
            <primevue-upload ref="input"
                :accept="enableAcceptFile"
                :choose-label="enableChooseLabel"
                :class="{
                    'has-error': field.error,
                    'is-creating': field.isCreating,
                }"
                :disabled="field.isDisabled || isUploading"
                :input-id="field.id"
                :invalid="!!field.error"
                :mode="enableMode"
                :maxFileSize="enableMaxFileSize"
                :multiple="enableMultiple"
                :name="`${enableName}[]`"
                :size="field.size"
                @select="onSelectedFiles">
                <template #header="{ chooseCallback, uploadCallback, clearCallback, files }">
                    <slot name="header" v-bind="{ chooseCallback, uploadCallback, clearCallback, files }" />
                </template>
                <template #content="{ files, uploadedFiles, removeUploadedFileCallback, removeFileCallback, messages }">
                    <slot name="content" v-bind="{ files, uploadedFiles, removeUploadedFileCallback, removeFileCallback, messages }" />
                </template>
                <template #empty>
                    <slot name="empty">{{ enableEmptyLabel }}</slot>
                </template>
                <template #chooseicon>
                    <slot name="uploadicon">
                        <i class="pi pi-spin pi-spinner" v-if="isUploading"></i>
                        <i class="pi pi-plus" v-else></i>
                    </slot>
                </template>
            </primevue-upload>
            <slot name="error" v-bind="field">
                <error-message :field="field" v-if="field.error" />
            </slot>
        </div>
        <div :class="field.after" v-if="field.after" />
    </form-field>
</template>

<script setup>
import { computed, ref } from 'vue';
import { useMessages } from '@/handlers/messages';
import ErrorMessage from '../parts/ErrorMessage.vue';
import FieldLabel from '../parts/FieldLabel.vue';
import FormField from './renderless/FormField.vue';
import LineBreak from '../parts/LineBreak.vue';
import PrimevueUpload from 'primevue/fileupload';

const { flashSuccess } = useMessages();

const input = ref(null);

const emit = defineEmits(['upload:complete']);

const props = defineProps({
    accepts: {
        type: String,
        default: null,
    },
    autofocus: {
        type: Boolean,
        default: false,
    },
    autoreset: {
        type: Boolean,
        default: false,
    },
    autoupload: {
        type: Boolean,
        default: false,
    },
    chooseLabel: {
        type: String,
        default: null,
    },
    emptyLabel: { // only 'advanced' mode
        type: String,
        default: null,
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
    mode: {
        type: String,
        default: null,
    },
    multiple: {
        type: Boolean,
        default: false,
    },
    uploaded: {
        type: Function,
        required: false,
    },
    url: {
        type: String,
        default: null,
    },
});

const hasUrl = (typeof props.url !== 'undefined' && typeof props.field.url !== 'undefined');
const isUploading = ref(false);

const enableAcceptFile = computed(() => props.accept || props.accept || null);
const enableAutoReset = computed(() => props.autoreset === true || props.field.autoreset === true);
const enableAutoUpload = computed(() => hasUrl
    && (props.mode === 'advanced' || props.field.mode === 'advanced')
    && (props.autoupload === true || props.field.autoupload === true));
const enableChooseLabel = computed(() => props.chooseLabel || props.field.chooseLabel || 'Browse');
const enableEmptyLabel = computed(() => props.emptyLabel || props.field.emptyLabel || 'No file selected');
const enableMaxFileSize = computed(() => props.maxFileSize || props.field.maxFileSize || null);
const enableMode = computed(() => props.mode || props.field.mode || 'basic');
const enableMultiple = computed(() => props.multiple === true || props.field.multiple === true);
const enableName = computed(() => props.name || props.field.name || props.field.id);
const enableUrl = computed(() => props.url || props.field.url);

const clearSelectedFiles = () => {
    input.value.clear();
    input.value.totalSize = 0;
    input.value.totalSizePercent = 0;
};

const onSelectedFiles = (payload) => {
    props.form[props.id] = enableMultiple.value === true
        ? payload.files
        : payload.files[0];

    if (props.autoupload === true || props.field.autoupload === true && hasUrl) {
        const headers = {'Content-Type': 'multipart/form-data'};
        const data = props.form.data();
        const url = props.url || props.field.url;
        isUploading.value = true;
        axios.post(url, data, { headers })
            .then((response) => {
                isUploading.value = false;
                const { data } = response;
                if (data.success) {
                    flashSuccess(data.success);
                }
                if (typeof props.uploaded === 'function') {
                    props.uploaded(data);
                }
                if (enableAutoReset.value === true) {
                    props.form.reset();
                    clearSelectedFiles();
                }
                emit('upload:complete');
            })
            .catch((e) => {
                if (e.response) {
                    const { response, status } = e;
                    if (status === 422) {
                        const { errors } = response.data;
                        Object.keys(errors).forEach((each) => {
                            errors[each] = errors[each][0];
                        });
                        props.form.setError(errors);
                    }
                }
                isUploading.value = false;
            });
    }
};
</script>
