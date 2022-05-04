<template>
    <main class="content main">
        <page-header back-button :title="title"/>
        <section class="auto-margin container max-width-xl w-full">
            <div class="grid">
                <div class="col-12">
                    Member Profile Page
                </div>
            </div>
        </section>
    </main>
</template>

<script>
import AppLayout from '@/layouts/App.vue';
import PageHeader from '@/components/ui/pages/PageHeader.vue';
import PrimevueButton from 'primevue/button';

export default {
    layout: AppLayout,

    components: {
        PageHeader,
        PrimevueButton,
    },

    props: {
        account: {
            type: Object,
            required: true,
        },
    },

    computed: {
        title() {
            return this.account.is_myself ? 'My Profile' : this.account.profile.name;
        },
    },
};
</script>
