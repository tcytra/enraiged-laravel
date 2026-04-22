<template>
    <form class="form flex flex-col lg:flex-row mt-1" @submit.prevent="submit">
        <avatar class="w-[8rem]" size="xl" :avatar="form" />
        <div class="controls flex items-center flex-grow-1 ml-5" v-if="form.file">
            <primevue-button class="p-button-sm p-button-danger mr-2" icon="pi pi-times"
                v-tooltip.top="i18n('Remove this avatar')"
                @click="destroy"/>
            {{ model.avatar.file.name }}
        </div>
        <div class="controls flex-grow-1 ml-6" v-else>
            <div class="flex items-center my-2">
                <primevue-colorpicker class="primevue-colorpicker mr-1" style="" v-model="color"/>
                <primevue-inputtext class="w-[96px]" v-model="color"/>
                <primevue-button class="ml-1" icon="pi pi-eye"
                    v-if="!changed"
                    v-tooltip.top="i18n('Preview this color')"
                    :disabled="`#${color}` === form.color"
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
            <div class="flex flex-col my-2">
                <primevue-fileupload class="p-button-primary p-button-icon-only"
                    accept="image/*"
                    mode="basic"
                    name="files[]"
                    icon="pi pi-plus"
                    :custom-upload="true"
                    @select="upload"/>
                <label class="text-sm mt-2">
                    {{ i18n('Upload an avatar image') }}
                    <br>
                    (max: 256x256 pixels)
                </label>
            </div>
        </div>
    </form>
</template>

<script setup>
import { inject, onMounted, ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { useHandlers } from '@/handlers';
import Avatar from '@/components/ui/avatars/Avatar.vue';
import HiddenField from '@/components/forms/fields/HiddenField.vue';
import PrimevueButton from 'primevue/button';
import PrimevueColorpicker from 'primevue/colorpicker';
import PrimevueFileupload from 'primevue/fileupload';
import PrimevueInputtext from 'primevue/inputtext';
import SecondaryButton from '@/components/ui/buttons/SecondaryButton.vue';

const props = defineProps({
    alert: {
        type: String,
    },
    errors: {
        type: Object,
    },
    isMyProfile: {
        type: Boolean,
    },
    model: {
        type: Object,
    },
});

const { state } = inject('app');

const { error, i18n } = useHandlers();

const { model } = props;

const changed = ref(false);

const color = ref(model.avatar.color);

const file = ref(null);

const form = ref({});

const destroy = () => {
    const method = 'delete';
    const url = route('avatars.delete', { avatar: model.avatar.id });

    axios({ method, url })
        .then(({ data }) => {
            if (data.success) {
                if (props.isMyProfile) {
                    state('auth');
                }
                model.avatar = data.avatar;
                reset();
            }
        })
        .catch((e) => error(e));
};

const preview = () => {
    form.value.color = `#${color.value}`;
    changed.value = true;
};

const reset = () => {
    form.value = { ...model.avatar };
    color.value = form.value.color.replace('#', '');
    changed.value = false;
};

const update = () => {
    const data = { color: color.value };
    const method = 'patch';
    const url = route('avatars.update', { avatar: model.avatar.id });

    axios({ method, url, data })
        .then(({ data }) => {
            if (data.success) {
                if (props.isMyProfile) {
                    state('auth');
                }
                model.avatar = data.avatar;
                reset();
            }
        })
        .catch((error) => {
            // console.log(error);
        });
};

const upload = (payload) => {
    file.value = payload.files[0];

    const form = useForm({ image: file.value });
    const data = form.data();
    const headers = {'Content-Type': 'multipart/form-data'};
    const method = 'post';
    const url = route('avatars.upload', { avatar: model.avatar.id });

    axios({ method, url, data, headers })
        .then(({ data }) => {
            if (data.success) {
                if (props.isMyProfile) {
                    state('auth');
                }
                model.avatar = data.avatar;
                reset();
            }
        })
        .catch((error) => {
            // console.log(error);
        });
};

onMounted(() => {
    reset();
});
</script>

<style>
    .p-colorpicker {
        .p-colorpicker-preview {
          height:       2.5rem;
          width:        2.5rem;
        }
    }
</style>
