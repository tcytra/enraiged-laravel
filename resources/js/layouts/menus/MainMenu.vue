<template>
    <menu-handler>
        <template v-slot:default="{ menu, navigate }">
            <ul class="options top-menu">
                <menu-item v-for="(item, name, index) in menu" :key="index"
                    :item="item"
                    :name="name"
                    @menu:navigate="navigate(name);"/>
            </ul>
        </template>
    </menu-handler>
</template>

<script>
import MenuHandler from './core/MenuHandler';
import MenuItem from '@/components/ui/menus/MenuItem';

export default {
    components: {
        MenuHandler,
        MenuItem,
    },
};
</script>
