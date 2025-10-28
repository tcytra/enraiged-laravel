<template>
    <div aria-haspopup="true" aria-controls="auth_select" class="action cursor-pointer" @click="toggle">
        <avatar :avatar="auth.user.avatar" hover />
    </div>
    <primevue-menu ref="menu" id="auth_select"
        :model="items"
        :popup="true">
        <template #start>
            <div class="text-center py-3">
                {{ auth.user.name }}
            </div>
        </template>
        <template #item="{ item, props }">
            <a class="flex items-center" v-bind="props.action"
                @click="handle(route, item)">
                <span :class="item.icon" />
                <span>{{ item.label }}</span>
            </a>
        </template>
    </primevue-menu>
</template>

<script setup>
import { inject, ref } from 'vue';
import { router } from '@inertiajs/vue3';
import { useMenus } from '@/handlers/menus';
import Avatar from '@/components/ui/avatars/Avatar.vue';
import PrimevueMenu from 'primevue/menu';

const props = defineProps({
    auth: {
        type: Object,
        required: true,
    },
    items: {
        type: Object,
        required: true,
    },
});

const { handle } = useMenus();

const route = inject('route');

const menu = ref();

const toggle = (event) => {
    menu.value.toggle(event);
};
</script>
