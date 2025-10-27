<template>
    <div aria-haspopup="true" aria-controls="auth_select" class="action cursor-pointer" @click="toggle">
        <avatar :avatar="auth.user.avatar" size="md" hover />
    </div>
    <primevue-menu ref="menu" id="auth_select" :model="items" :popup="true">
        <template #start>
            <div class="text-center py-3">
                {{ auth.user.name }}
            </div>
        </template>
        <template #item="{ item, props }">
            <a class="flex items-center" v-bind="props.action" @click="actionHandler(item)">
                <span :class="item.icon" />
                <span>{{ item.label }}</span>
            </a>
        </template>
    </primevue-menu>
</template>

<script setup>
import { inject, ref } from 'vue';
import { router } from '@inertiajs/vue3';
import Avatar from '@/components/ui/avatars/Avatar.vue';
import PrimevueMenu from 'primevue/menu';

const props = defineProps({
    auth: {
        type: Object,
        required: true,
    },
});

const route = inject('route');

const items = ref([
    {
        label: 'Profile',
        icon: 'pi pi-user',
        route: 'my.profile.edit',
    },
    {
        label: 'Logout',
        icon: 'pi pi-sign-out',
        method: props.auth.logout,
    }
]);

const menu = ref();

const toggle = (event) => {
    menu.value.toggle(event);
};

const actionHandler = (item) => {
    if (item.route) {
        routeHandler(item);
    }
    if (item.method) {
        item.method();
    }
};

const routeHandler = (item) => {
    if (typeof item.route === 'string') {
        router.get(item.route.match(/\//) ? item.route : route(item.route));
    }
};
</script>
