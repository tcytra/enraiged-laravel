<template>
    <div class="avatar-editor" :class="class">
        <avatar :avatar="model" size="xl"/>
        <div class="flex align-items-center mx-3" v-if="avatar.file">
            <primevue-button class="p-button-sm p-button-danger mr-2" icon="pi pi-times"
                v-tooltip.top="i18n('Remove this avatar')"
                @click="destroy"/>
            {{ avatar.file.name }}
        </div>
        <div class="flex flex-column justify-content-center mx-3" v-else>
            <div class="flex align-items-center my-2">
                <primevue-colorpicker class="mr-1" style="height:2.325rem;width:2.325rem;" v-model="color"/>
                <primevue-inputtext class="" v-model="color"/>
                <primevue-button class="ml-1" icon="pi pi-eye"
                    v-if="!changed"
                    v-tooltip.top="i18n('Preview this color')"
                    :disabled="`#${color}` === model.color"
                    @click="preview"/>
                <primevue-button class="p-button-danger ml-1" icon="pi pi-times"
                    v-if="changed"
                    v-tooltip.top="i18n('I don\'t like it!')"
                    @click="reset"/>
                <primevue-button class="p-button-success ml-1" icon="pi pi-check"
                    :disabled="!changed"
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

    inject: ['errorHandler', 'flashSuccess', 'i18n', 'initState', 'user'],

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
            const url = this.avatar.actions.delete.uri;
            this.axios({ method, url })
                .then(({ data }) => {
                    if (data.success) {
                        this.avatar.file = null;
                        this.reset(data);
                    }
                })
                .catch(error => this.errorHandler(error));
        },
        preview() {
            this.model.color = `#${this.color}`;
            this.changed = true;
        },
        reset(data) {
            this.model = { ...this.avatar };
            this.color = this.model.color.replace('#', '');
            this.changed = false;
            delete this.model.actions;
            if (typeof data !== 'undefined') {
                this.flashSuccess(data.success);
                if (this.avatar.id === this.user.avatar.id) {
                    this.initState();
                }
            }
        },
        update() {
            const data = { color: this.color };
            const method = this.avatar.actions.update.method;
            const url = this.avatar.actions.update.uri;
            this.axios({ method, url, data })
                .then(({ data }) => {
                    if (data.success) {
                        this.avatar.color = `#${data.color}`;
                        this.reset(data);
                    }
                })
                .catch(error => this.errorHandler(error));
        },
        upload(payload) {
            this.file = payload.files[0];
            const form = useForm({image: this.file});
            const data = form.data();
            const headers = {'Content-Type': 'multipart/form-data'};
            const method = this.avatar.actions.upload.method;
            const url = this.avatar.actions.upload.uri;
            this.axios({ method, url, data, headers })
                .then(({ data }) => {
                    if (data.success) {
                        this.avatar.file = data.file;
                        this.reset(data);
                    }
                })
                .catch(error => this.errorHandler(error));
        },
    },
};
</script>
