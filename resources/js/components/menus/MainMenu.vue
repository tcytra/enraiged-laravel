<template>
    <nav class="bg-bluegray-800 text-50" refs="nav">
        <header class="header">
            <dl class="branding">
                <dt class="icon">
                    <i class="pi pi-circle" style="color:orange;font-size:1.25rem;line-height:1.75rem;"></i>
                </dt>
                <dd class="text">enraiged-laravel</dd>
            </dl>
        </header>
        <ul class="options">
            <li class="each cursor-pointer" @click="get('/')"
                :class="match('') ? 'bg-bluegray-700' : 'hover:bg-bluegray-600'">
                <dl class="option">
                    <dt class="icon">
                        <i class="pi pi-home"></i>
                    </dt>
                    <dl class="text">
                        Dashboard
                    </dl>
                </dl>
            </li>
            <!--
            <li class="each cursor-pointer hover:bg-bluegray-600" @click="get('/users')">
                <dl class="option">
                    <dt class="icon">
                        <i class="pi pi-users"></i>
                    </dt>
                    <dl class="text">
                        Manage Users
                    </dl>
                </dl>
            </li>
            -->
        </ul>
        <footer class="footer">
            <div class="block cursor-pointer hover:bg-bluegray-600" @click="$emit('toggle-menu')" refs="navToggle">
                <i class="pi pi-bars"></i>
            </div>
        </footer>
    </nav>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Link,
    },
    props: {
        menuOpen: Boolean,
    },
    methods: {
        get(url) {
            this.$inertia.get(url);
        },
        match(...urls) {
            let currentUrl = this.$page.url.substr(1)
            if (urls[0] === '') {
                return currentUrl === ''
            }
            return urls.filter((url) => currentUrl.startsWith(url)).length
        },
    },
};
</script>
