<template>
    <nav class="nav top">
        <div class="inline action"
            @click="$emit('menu:toggle')">
            <i class="pi pi-bars"></i>
        </div>
        <div class="block"/>
        <div class="inline action impersonating" v-if="auth.is_impersonating"
            @click="stopImpersonating()">
            <i class="pi pi-user-minus"></i>
        </div>
        <div class="inline action"
            @click="$emit('auth:toggle')">
            <avatar :avatar="auth.avatar" hover size="md"/>
        </div>
    </nav>
</template>

<script>
import Avatar from '@/components/ui/avatars/Avatar.vue';

export default {
    emits: ['auth:toggle', 'menu:toggle'],

    inject: ['auth', 'stopImpersonating'],

    components: {
        Avatar,
    },
};
</script>
