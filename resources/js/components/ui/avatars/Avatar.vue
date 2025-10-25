<template>
    <div class="avatar">
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
import PrimevueAvatar from 'primevue/avatar';

const props = defineProps({
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
    };
};

const backgroundClass = computed(() => classes());

const backgroundColor = computed(() => `background-color:${props.avatar.color};`);
</script>
