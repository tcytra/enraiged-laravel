<template>
    <primevue-confirm id="confirm">
        <template #container="{ message, acceptCallback, rejectCallback }">
            <slot name="container" v-bind="{ message, acceptCallback, rejectCallback }">
                <div class="flex flex-col items-center p-8 bg-surface-0 dark:bg-surface-900 rounded">
                    <div class="rounded-full bg-primary text-primary-contrast inline-flex justify-center items-center h-16 w-16 -mt-16"
                        v-if="showIcon">
                        <i class="pi pi-question !text-4xl"></i>
                    </div>
                    <span class="font-bold text-2xl block mb-2 mt-6">
                        {{ message.header }}
                    </span>
                    <p class="mb-0">
                        {{ message.message }}
                    </p>
                    <div class="flex items-center gap-2 mt-6">
                        <primary-button class="w-32"
                            :label="confirmText"
                            @click="accepted(); acceptCallback()" />
                        <outlined-button  class="w-32" outlined
                            :label="cancelText"
                            @click="rejected(); rejectCallback()" />
                    </div>
                </div>
            </slot>
        </template>
    </primevue-confirm>
</template>

<script setup>
import { ref } from 'vue';
import { trans as i18n } from 'laravel-vue-i18n';
import { useConfirm } from "primevue/useconfirm";
import PrimaryButton from '@/components/ui/buttons/PrimaryButton.vue';
import OutlinedButton from '@/components/ui/buttons/OutlinedButton.vue';
import PrimevueConfirm from 'primevue/confirmdialog';

const props = defineProps({
    cancelText: {
        type: String,
        default: 'Cancel',
    },
    confirmText: {
        type: String,
        default: 'Proceed',
    },
    header: {
        type: String,
        default: 'Confirmation',
    },
    message: {
        type: String,
        default: 'Are you sure you want to proceed?',
    },
    showIcon: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(['accepted', 'rejected']);
const confirm = useConfirm();
const confirming = ref(false);

const accepted = () => {
    emit('accepted');
};

const rejected = () => {
    emit('rejected');
};

const openConfirm = () => {
    confirm.require({
        header: i18n(props.header),
        message: i18n(props.message),
        onShow: () => {
            confirming.value = true;
        },
        onHide: () => {
            confirming.value = false;
        }
    });
};

defineExpose({
    open: openConfirm,
});
</script>
