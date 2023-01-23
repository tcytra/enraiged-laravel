<template>
    <nav class="text-50" refs="nav">
        <header class="header">
            <dl class="branding">
                <dt class="icon">
                    <i class="pi pi-circle" style="color:orange;font-size:1.25rem;line-height:1.75rem;"></i>
                </dt>
                <dd class="text">{{ meta.app_name }}</dd>
            </dl>
        </header>
        <main-menu/>
        <div class="block flex-grow-1" @click="$emit('menu:toggle')"/>
        <footer class="footer">
            <div class="action" @click="$emit('menu:toggle')" refs="navToggle">
                <i class="pi pi-bars"></i>
            </div>
        </footer>
    </nav>
</template>

<script>
import MainMenu from '../menus/MainMenu.vue';

export default {
    components: {
        MainMenu,
    },

    emits: ['menu:toggle'],

    inject: ['meta'],
};
</script>
