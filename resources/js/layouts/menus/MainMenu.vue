<template>
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
        <li class="each cursor-pointer hover:bg-bluegray-600" @click="get('/account')"
            :class="match('account') ? 'bg-bluegray-700' : 'hover:bg-bluegray-600'">
            <dl class="option">
                <dt class="icon">
                    <i class="pi pi-user"></i>
                </dt>
                <dl class="text">
                    Account
                </dl>
            </dl>
        </li>
        -->
    </ul>
</template>

<script>
export default {
    methods: {
        get(url) {
            this.$emit('menu:navigate');
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
