<template>
    <vue-table ref="datatable"
        :page-report-template="'Showing {first} to {last} of {totalRecords} users'"
        :template="template">
        <template v-slot:name="{ data }">
            <div class="flex flex-row gap-3 items-center">
                <avatar :action="data.actions.show" :avatar="data.avatar" size="md" v-if="data.actions" />
                <avatar :avatar="data.avatar" size="md" v-else />
                <span class="">{{ data.name }}</span>
            </div>
        </template>
        <template v-slot:status="{ data }">
            <primevue-badge class="p-badge-danger" :value="i18n('Deleted')" v-if="data.is_deleted || data.deleted_at" />
            <primevue-badge class="p-badge-success" :value="i18n('Active')" v-else-if="data.is_active" />
            <primevue-badge class="p-badge-warn" :value="i18n('Inactive')" v-else />
        </template>
    </vue-table>
</template>

<script setup>
import { useLocales } from '@/handlers/locales';
import Avatar from '@/components/ui/avatars/Avatar.vue';
import PrimevueBadge from 'primevue/badge';
import PrimevueTooltip from 'primevue/tooltip';
import VueTable from '@/components/tables/VueTable.vue';

defineProps({
    template: {
        type: Object,
        required: true,
    },
});

const { i18n } = useLocales();
</script>
