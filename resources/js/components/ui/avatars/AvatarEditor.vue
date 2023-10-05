<template>
    <div class="avatar-editor" :class="class">
        <avatar :avatar="model" size="xl"/>
        <div class="flex align-items-center mx-3" v-if="avatar.file">
            <primevue-button class="p-button-xs p-button-danger mr-2" icon="pi pi-times"
                v-tooltip.top="i18n('Remove this avatar')"
                @click="destroy"/>
            {{ avatar.file.name }}
        </div>
        <div class="flex flex-column justify-content-center mx-3" v-else>
            <div class="flex align-items-center my-2">
                <primevue-colorpicker v-model="color"/>
                <primevue-inputtext class="p-inputtext-sm" v-model="color"/>
                <primevue-button class="p-button-sm ml-2" icon="pi pi-eye"
                    v-if="!changed"
                    v-tooltip.top="i18n('Preview this color')"
                    :disabled="`#${color}` === model.color"
                    @click="preview"/>
                <primevue-button class="p-button-sm p-button-danger ml-1" icon="pi pi-times"
                    v-if="changed"
                    v-tooltip.top="i18n('I don\'t like it!')"
                    @click="reset"/>
                <primevue-button class="p-button-sm p-button-success ml-1" icon="pi pi-check"
                    v-if="changed"
                    v-tooltip.top="i18n('I like it!')"
                    @click="update"/>
            </div>
            <div class="flex align-items-center my-2">
                <primevue-fileupload class="p-button-primary p-button-icon-only"
                    accept="image/*"
                    mode="basic"
                    name="files[]"
                    icon="pi pi-plus"
                    :custom-upload="true"
                    @select="upload"/>
                <label class="text-sm mx-2">
                    {{ i18n('Upload an avatar image') }}
                    <br>
                    (max: 256x256 pixels)
                </label>
            </div>
        </div>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/vue3'
import Avatar from '@/components/ui/avatars/Avatar.vue';
import PrimevueButton from 'primevue/button/Button.vue';
import PrimevueColorpicker from 'primevue/colorpicker/ColorPicker.vue';
import PrimevueFileupload from 'primevue/fileupload/FileUpload.vue';
import PrimevueInputtext from 'primevue/inputtext/InputText.vue';
import PrimevueTooltip from 'primevue/tooltip/tooltip.esm.js';

export default {
    components: {
        Avatar,
        PrimevueButton,
        PrimevueColorpicker,
        PrimevueFileupload,
        PrimevueInputtext,
    },

    directives: {
        tooltip: PrimevueTooltip,
    },

    inject: ['i18n'],

    props: {
        avatar: {
            type: Object,
            required: true,
        },
        class: {
            type: String,
            default: 'flex align-items-center justify-content-center my-1',
        },
    },

    data: () => ({
        changed: false,
        color: null,
        file: null,
        model: null,
    }),

    created() {
        this.reset();
    },

    methods: {
        destroy() {
            const method = this.avatar.actions.delete.method;
            const uri = this.avatar.actions.delete.uri;
            this.$inertia[method](uri, { onSuccess: () => this.reset()});
        },
        preview() {
            this.model.color = `#${this.color}`;
            this.changed = true;
        },
        reset() {
            this.model = { ...this.avatar };
            this.color = this.model.color.replace('#', '');
            this.changed = false;
            delete this.model.actions;
        },
        update() {
            const method = this.avatar.actions.update.method;
            const uri = this.avatar.actions.update.uri;
            this.$inertia[method](uri, { color: this.color }, { onSuccess: () => this.reset()});
        },
        upload(payload) {
            this.file = payload.files[0];
            const form = useForm({
                image: this.file,
            });
            const method = this.avatar.actions.upload.method;
            const uri = this.avatar.actions.upload.uri;
            form[method](uri, { onSuccess: () => this.reset()});
        },
    },
};
</script>
