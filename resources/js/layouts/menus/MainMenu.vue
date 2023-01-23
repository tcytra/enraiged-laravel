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
import MenuHandler from './core/MenuHandler.vue';
import MenuItem from '@/components/ui/menus/MenuItem.vue';

export default {
    components: {
        MenuHandler,
        MenuItem,
    },
};
</script>
