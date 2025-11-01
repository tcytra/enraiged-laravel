<template>
    <vue-table ref="datatable"
        :page-report-template="'Showing {first} to {last} of {totalRecords} users'"
        :template="template"
        @show="show">
        <template v-slot:avatar="{ data }">
            <avatar :avatar="data.avatar" size="md" />
        </template>
        <template v-slot:is_active="{ data }">
            <primevue-badge class="p-badge-danger" :value="i18n('Deleted')" v-if="data.deleted || data.deleted_at" />
            <primevue-badge class="p-badge-success" :value="i18n('Active')" v-else-if="data.is_active" />
            <primevue-badge class="p-badge-warn" :value="i18n('Inactive')" v-else />
        </template>
    </vue-table>
</template>

<script>
import { trans as i18n } from 'laravel-vue-i18n';
import Avatar from '@/components/ui/avatars/Avatar.vue';
import PrimevueBadge from 'primevue/badge';
import PrimevueTooltip from 'primevue/tooltip';
import VueTable from '@/components/tables/VueTable.vue';

export default {
    components: {
        Avatar,
        PrimevueBadge,
        VueTable,
    },

    directives: {
        tooltip: PrimevueTooltip,
    },

    props: {
        template: {
            type: Object,
            required: true,
        },
    },

    computed: {
        i18n() {
            return i18n;
        },
    },

    methods: {
        avatar(data) {
            if (typeof data.avatar === 'object') {
                return data.avatar;
            }
            const avatar = {
                id: data.avatar.id || data.avatar,
                chars: data.first_name.substring(0, 1) + data.last_name.substring(0, 1),
                color: '#'
                    + this.hex((data.avatar_color >> 16) & 0xFF)
                    + this.hex((data.avatar_color >> 8) & 0xFF)
                    + this.hex(data.avatar_color & 0xFF),
                file: this.file(data),
            };
            return avatar;
        },
        file(data) {
            if (data.avatar_file_name) {
                return { name: data.avatar_file_name, uri: data.avatar_file_url };
            }
            if (data.avatar.file) {
                return { name: data.avatar.file.name, uri: data.avatar.file.url };
            }
            return null;
        },
        multipleDesignations(row) {
            if (row.designation && row.designation.split(',').length > 1) {
                return true;
            }
            return false;
        },
        hex(value) {
            const hex = value.toString(16);
            return hex < 10 ? `0${hex}` : hex;
        },
        show({ action, row }) {
            if (action.uri) {
                this.$inertia.get(action.uri);
            }
        },
    },
};
</script>
