<template>
    <nav class="text-50" refs="nav">
        <header class="header profile">
            <avatar size="xx" :avatar="auth.avatar"/>
            <h4 class="name">{{ auth.profile.name }}</h4>
            <h5 class="email">{{ auth.email }}</h5>
        </header>
        <ul class="options">
            <li class="action item" @click="get('/my/account')">
                <dl class="option">
                    <dt class="icon">
                        <i class="pi pi-user"></i>
                    </dt>
                    <dl class="text">
                        {{ i18n('Profile') }}
                    </dl>
                </dl>
            </li>
            <li class="action item" @click="get('/my/files')">
                <dl class="option">
                    <dt class="icon">
                        <i class="pi pi-file"></i>
                    </dt>
                    <dl class="text">
                        {{ i18n('Files') }}
                    </dl>
                </dl>
            </li>
            <li class="action item" @click="logout">
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
        <hr class="my-3 "/>
        <div class="text-center text-sm my-1">Contacts</div>
        <div class="text-center text-sm my-1">Notifications</div>
        -->
        <div class="block flex-grow-1" @click="close"/>
        <footer class="footer">
            <div class="action" @click="close" refs="navToggle">
                <i class="pi pi-bars"></i>
            </div>
        </footer>
    </nav>
</template>

<script>
import Avatar from '@/components/ui/avatars/Avatar.vue';

export default {
    components: {
        Avatar,
    },

    emits: ['auth:close', 'auth:toggle'],

    inject: ['auth', 'currentTheme', 'i18n', 'logout', 'meta'],

    methods: {
        close() {
            this.$emit('auth:close');
        },
        get(url) {
            this.close();
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
