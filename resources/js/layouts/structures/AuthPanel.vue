<template>
    <nav class="nav">
        <header class="header profile">
            <avatar size="xx" :avatar="auth.user.avatar" />
            <h4 class="name">{{ auth.user.name }}</h4>
            <h5 class="email">{{ auth.user.email }}</h5>
        </header>
        <ul class="navigation options">
            <li class="action item" @click="handle(route, item, auth, auth.open)"
                :class="{ 'current': active(route, item) }">
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
        <!--
        <div class="m-[2rem]" v-if="files.length">
            <div class="font-semibold text-sm mb-2">My Recent Files</div>
            <ul class="files options">
                <li class="file item" v-for="file in files">
                    <span class="text-xs">{{ file.name }}</span>
                </li>
            </ul>
        </div>
        -->
        <div class="block flex-grow-1" @click="auth.toggle()" />
    </nav>
</template>

<script setup>
import { computed, ref } from 'vue';
import { useLocales } from '@/handlers/locales';
import { useMenus } from '@/handlers/menus';
import { usePage } from '@inertiajs/vue3';
import Avatar from '@/components/ui/avatars/Avatar.vue';

const props = defineProps({
    auth: {
        type: Object,
        required: true,
    },
    meta: {
        type: Object,
        required: true,
    },
});

const { i18n } = useLocales();

const { active, handle } = useMenus();

const item = ref({ route: { name: 'my.profile.show' } });

const mobile = ref(props.meta.agent === 'mobile');

const page = usePage();

const files = computed(() => page.props.files || []);
</script>
