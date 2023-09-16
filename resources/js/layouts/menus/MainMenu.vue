<template>
    <menu-handler>
        <template v-slot:default="{ menu, navigate }">
            <ul class="options top-menu">
                <menu-item v-for="(item, name, index) in menu"
                    :item="item"
                    :key="index"
                    :name="name"
                    @menu:navigate="navigate(name)"/>
            </ul>
        </template>
    </menu-handler>
</template>

<script>
import { defineAsyncComponent } from 'vue';
import MenuHandler from './core/MenuHandler.vue';

export default {
    components: {
        MenuHandler,
        MenuItem: defineAsyncComponent(() => import('@/components/ui/menus/MenuItem.vue')),
    },
};
</script>
