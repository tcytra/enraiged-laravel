<template>
    <nav class="nav">
        <header class="header profile">
            <avatar size="xx" :avatar="auth.avatar"/>
            <h4 class="name">{{ auth.user.name }}</h4>
            <h5 class="email">{{ auth.user.email }}</h5>
        </header>
        <ul class="navigation options">
            <li class="action item" @click="get('/my/profile/edit');auth.toggle()">
                <dl class="option">
                    <dt class="icon">
                        <i class="pi pi-user"></i>
                    </dt>
                    <dl class="text">
                        {{ i18n('Profile') }}
                    </dl>
                </dl>
            </li>
            <li class="action item" @click="auth.logout()">
                <dl class="option">
                    <dt class="icon">
                        <i class="pi pi-sign-out"></i>
                    </dt>
                    <dl class="text">
                        {{ i18n('Logout') }}
                    </dl>
                </dl>
            </li>
        </ul>
        <div class="block flex-grow-1" @click="auth.toggle()"/>
    </nav>
</template>

<script setup>
import { inject } from 'vue';
import { router } from '@inertiajs/vue3';
import Avatar from '@/components/ui/avatars/Avatar.vue';

defineProps({
    auth: {
        type: Object,
        required: true,
    },
    meta: {
        type: Object,
        required: true,
    },
});

const { i18n } = inject('intl');

const get = (url) => {
    router.get(url);
};
</script>
