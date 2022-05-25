<template>
    <ul class="options sub-menu"
        :class="{ 'is-open': open }">
        <menu-item v-for="(item, name) in menu" :key="name"
            :item="item"
            :name="name"
            @menu:navigate="$emit('menu:navigate')"/>
    </ul>
</template>

<script>
import { defineAsyncComponent } from 'vue';

export default {
    components: {
        MenuItem: defineAsyncComponent(() => import('@/components/ui/menus/MenuItem.vue')),
    },

    props: {
        menu: {
            type: Object,
            required: true,
        },
        open: {
            type: Boolean,
            default: false,
        },
    },
};
</script>
