<template>
    <div class="avatar" @click="navigate">
        <primevue-avatar shape="circle" v-if="avatar.file"
            :class="backgroundClass"
            :image="avatar.file.url" />
        <primevue-avatar shape="circle" v-else
            :class="backgroundClass"
            :label="avatar.chars"
            :style="backgroundColor" />
    </div>
</template>

<script setup>
import { computed } from 'vue';
import { router } from '@inertiajs/vue3';
import PrimevueAvatar from 'primevue/avatar';

const props = defineProps({
    action: {
        type: Object,
        default: null,
    },
    avatar: {
        type: Object,
        default: null,
    },
    size: {
        type: String,
        default: null,
    },
});

const classes = () => {
    return {
        'avatar-sm': props.size === 'sm',
        'avatar-md': props.size === 'md',
        'avatar-lg': props.size === 'lg',
        'avatar-xl': props.size === 'xl',
        'avatar-xx': props.size === 'xx',
        'cursor-pointer': props.action,
    };
};

const backgroundClass = computed(() => classes());

const backgroundColor = computed(() => `background-color:${props.avatar.color};`);

const navigate = () => {
    if (props.action) {
        const { method, url } = props.action.route;
        router[method](url);
    }
};
</script>
