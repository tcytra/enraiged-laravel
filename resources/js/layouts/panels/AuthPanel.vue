<template>
    <nav class="text-50" refs="nav">
        <header class="header profile">
            <account-avatar :initials="auth.user.profile.initials" />
            <h4 class="name">{{ auth.user.profile.name }}</h4>
        </header>
        <ul class="options">
            <li class="action each" @click="get('/my/account')">
                <dl class="option">
                    <dt class="icon">
                        <i class="pi pi-user"></i>
                    </dt>
                    <dl class="text">
                        Account
                    </dl>
                </dl>
            </li>
            <li class="action each" @click="logout">
                <dl class="option">
                    <dt class="icon">
                        <i class="pi pi-sign-out"></i>
                    </dt>
                    <dl class="text">
                        Logout
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
import { useForm } from '@inertiajs/inertia-vue3'
import AccountAvatar from '@/components/accounts/Avatar.vue';

export default {
    emits: ['auth:toggle'],

    components: {
        AccountAvatar,
    },

    props: {
        auth: {
            type: Object,
            required: true,
        },
    },

    methods: {
        close() {
            this.$emit('auth:toggle');
        },
        get(url, close) {
            if (close === true) {
                this.close();
            }
            this.$inertia.get(url);
        },
        logout() {
            useForm().delete('/logout');
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
