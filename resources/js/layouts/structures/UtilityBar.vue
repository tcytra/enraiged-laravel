<template>
    <div>
        <div class="action cursor-pointer"
            @click="menu.toggle()">
            <i class="pi pi-bars"></i>
        </div>
        <div class="group"></div>
        <div class="action cursor-pointer impersonating" v-if="auth.user && auth.user.is_impersonating"
            v-tooltip.left="'Stop impersonating'"
            @click="unimpersonate()">
            <i class="pi pi-user-minus"></i>
        </div>
        <toggle-dark-mode :theme="theme" class="action cursor-pointer" />
        <toggle-palette :theme="theme" class="action cursor-pointer" />
        <div class="action cursor-pointer" v-if="auth.user && authPanel"
            @click="auth.toggle()">
            <avatar :avatar="auth.user.avatar" hover />
        </div>
        <auth-select-utility :auth="auth" v-if="auth.user && authSelect" />
        <div class="action cursor-pointer" v-if="auth.user && meta.layout.logout"
            @click="auth.logout()">
            <i class="pi pi-sign-out"></i>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';
import { router } from '@inertiajs/vue3';
import AuthSelectUtility from '@/components/ui/utilities/AuthSelectUtility.vue';
import Avatar from '@/components/ui/avatars/Avatar.vue';
import PrimevueTooltip from 'primevue/tooltip';
import ToggleDarkMode from '@/components/ui/utilities/ToggleDarkMode.vue';
import TogglePalette from '@/components/ui/utilities/TogglePalette.vue';

const props = defineProps({
    auth: {
        type: Object,
        required: true,
    },
    menu: {
        type: Object,
        required: true,
    },
    meta: {
        type: Object,
        required: true,
    },
    theme: {
        type: Object,
        default: null,
    },
});

const layout = props.meta.layout;
const authPanel = computed(() => layout.auth === 'panel');
const authSelect = computed(() => layout.auth === 'select');

const unimpersonate = () => {
    router.get(route('users.impersonate.stop'));
};
</script>
