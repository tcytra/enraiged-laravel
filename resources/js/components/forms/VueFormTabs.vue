<template>
    <tab-view class="my-3 shadow-1" ref="tabview">
        <tab-panel :header="tab.heading" v-for="(tab, key) in template.fields" :key="key">
            <vue-form-tab
                :creating="creating"
                :form="form"
                :tab="tab"
                :template="template"
                :updating="updating">
                <template v-if="tab.custom" v-slot:[key]="props">
                    <slot :name="key" v-bind="{ creating, tab, form, key, updating }"/>
                </template>
            </vue-form-tab>
        </tab-panel>
    </tab-view>
</template>

<script>
import TabPanel from 'primevue/tabpanel/TabPanel.vue';
import TabView from 'primevue/tabview/TabView.vue';
import VueFormTab from './VueFormTab.vue';

export default {
    components: {
        TabPanel,
        TabView,
        VueFormTab,
    },

    props: {
        creating: {
            type: Boolean,
            default: false,
        },
        form: {
            type: Object,
            required: true,
        },
        template: {
            type: Object,
            required: true,
        },
        updating: {
            type: Boolean,
            default: false,
        },
    },
};
</script>
