<template>
    <nav class="nav top">
        <div class="inline action"
            @click="$emit('menu:toggle')">
            <i class="pi pi-bars"></i>
        </div>
        <div class="block" />
        <div class="inline action"
            @click="$emit('auth:toggle')">
            <avatar :avatar="$page.props.auth.user.avatar" hover size="md"/>
        </div>
    </nav>
</template>

<script>
import Avatar from '@/components/ui/avatars/Avatar.vue';

export default {
    emits: ['auth:toggle', 'menu:toggle'],

    components: {
        Avatar,
    },
};
</script>
