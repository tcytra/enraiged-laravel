<template>
    <main class="content main">
        <page-header fixed title="Users" />

        <section class="datatable section">
            <user-index :template="table" />
        </section>
    </main>
</template>

<script setup>
import DefaultLayout from '@/layouts/DefaultLayout.vue';
import PageHeader from '@/components/ui/PageHeader.vue';
import UserIndex from '@/components/users/tables/UserIndex.vue';

defineOptions({
    layout: DefaultLayout,
});

defineProps({
    table: {
        type: Object,
        required: true,
    }
});
</script>
