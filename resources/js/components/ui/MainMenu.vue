<template>
    <ul class="navigation options">
        <li class="item">
            <dl class="option cursor-pointer" @click="$emit('menu:navigate', {route: '/dashboard'})">
                <dt class="icon">
                    <i class="pi pi-home"></i>
                </dt>
                <dl class="text">
                    {{ i18n('Dashboard') }}
                </dl>
            </dl>
        </li>
    </ul>
</template>

<script setup>
import { inject } from 'vue';

defineEmits(['menu:navigate']);

defineProps({
    menu: {
        type: Object,
        required: true,
    },
});

const { i18n } = inject('intl');
</script>
