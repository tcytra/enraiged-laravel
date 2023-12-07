<template>
    <main class="content main">
        <page-header back-button fixed :actions="actions" :title="title"/>
        <section class="auto-margin container max-width-xl w-full">
            <div class="grid">
                <div class="col-12">
                    {{ i18n('Member Profile Page') }}
                </div>
            </div>
        </section>
    </main>
</template>

<script>
import App from '@/layouts/App.vue';
import PageHeader from '@/components/ui/pages/PageHeader.vue';
import PrimevueButton from 'primevue/button/Button.vue';

export default {
    layout: App,

    components: {
        PageHeader,
        PrimevueButton,
    },

    inject: ['i18n'],

    props: {
        actions: {
            type: Array,
            default: [],
        },
        user: {
            type: Object,
            required: true,
        },
    },

    computed: {
        title() {
            return this.user.is_myself ? 'My Profile' : this.user.profile.name;
        },
    },
};
</script>
