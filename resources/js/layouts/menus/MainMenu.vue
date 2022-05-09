<template>
    <ul class="options">
        <li class="each cursor-pointer" @click="get('/')"
            :class="match('') ? 'bg-bluegray-700' : 'hover:bg-bluegray-600'">
            <dl class="option">
                <dt class="icon">
                    <i class="pi pi-home"></i>
                </dt>
                <dl class="text">
                    {{ i18n('Dashboard') }}
                </dl>
            </dl>
        </li>
        <li class="each cursor-pointer" @click="get('/accounts')"
            :class="match('accounts') ? 'bg-bluegray-700' : 'hover:bg-bluegray-600'">
            <dl class="option">
                <dt class="icon">
                    <i class="pi pi-user"></i>
                </dt>
                <dl class="text">
                    {{ i18n('Accounts') }}
                </dl>
            </dl>
        </li>
    </ul>
</template>

<script>
export default {
    inject: ['i18n'],

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
