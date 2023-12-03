<template>
    <vue-table ref="datatable"
        :page-report-template="'Showing {first} to {last} of {totalRecords} users'"
        :template="template"
        @show="show">
        <template v-slot:avatar="{ data }">
            <avatar :action="data.actions.show" :avatar="avatar(data)"/>
        </template>
        <template v-slot:is_active="{ data }">
            <primevue-badge class="p-badge-danger" value="Deleted" v-if="data.deleted || data.deleted_at"/>
            <primevue-badge class="p-badge-success" value="Active" v-else-if="data.is_active"/>
            <primevue-badge class="p-badge-warning" value="Inactive" v-else/>
        </template>
        <template v-slot:created="{ data }">
            <span>{{ data.created.at.short }}</span>
        </template>
    </vue-table>
</template>

<script>
import { format as dateFnsFormat } from 'date-fns';
import Active from '@/components/ui/indicators/Active.vue';
import Avatar from '@/components/ui/avatars/Avatar.vue';
import PrimevueBadge from 'primevue/badge';
import VueTable from '@/components/tables/VueTable.vue';

export default {
    components: {
        Active,
        Avatar,
        PrimevueBadge,
        VueTable,
    },

    props: {
        template: {
            type: Object,
            required: true,
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
        date(value) {
            const date = new Date(value);
            return dateFnsFormat(date, 'MMM d, yyyy');
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
