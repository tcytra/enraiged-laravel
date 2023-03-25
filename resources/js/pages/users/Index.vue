<template>
    <main class="content main">
        <page-header fixed title="Users"/>
        <section class="container table">
            <user-index :template="template" />
        </section>
    </main>
</template>

<script>
import App from '@/layouts/App.vue';
import PageHeader from '@/components/ui/pages/PageHeader.vue';
import UserIndex from '@/components/users/tables/UserIndex.vue';

export default {
    layout: App,

    components: {
        PageHeader,
        UserIndex,
    },

    props: {
        template: {
            type: Object,
            required: true,
        },
    },
};
</script>
