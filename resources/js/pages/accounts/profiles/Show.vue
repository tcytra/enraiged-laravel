<template>
    <main class="account content dashboard flex-column main flex">
        <header class="flex header justify-content-between">
            <Head :title="pageTitle"/>
            <h1>{{ pageTitle }}</h1>
        </header>
        <section class="align-self-center container max-width-xl w-full">
            <div class="grid">
                <div class="col-12">
                    
                </div>
            </div>
        </section>
    </main>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';
import AppLayout from '@/layouts/App.vue';
import PrimevueButton from 'primevue/button';

export default {
    layout: AppLayout,

    components: {
        Head,
        PrimevueButton,
    },

    props: {
        account: {
            type: Object,
            required: true,
        },
        actions: {
            type: Object,
            required: true,
        },
    },

    computed: {
        isMyAccount() {
            return this.$attrs.auth.user.id === this.account.id;
        },
        pageTitle() {
            return this.isMyAccount ? 'My Profile' : this.account.profile.name;
        },
    },
};
</script>
