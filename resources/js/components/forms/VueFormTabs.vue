<template>
    <tab-view class="my-3 shadow-1" ref="tabview">
        <tab-panel :header="tab.name" v-for="(tab, key) in template.fields" :key="key">
            <header class="header mb-3" v-if="tab.heading"
                :class="[ tab.heading.class ]">
                <span class="text">{{ i18n(tab.heading.body || tab.heading) }}</span>
            </header>
            <div class="precontent mb-3" v-if="tab.precontent"
                :class="[ tab.precontent.class ]">
                {{ i18n(tab.precontent.body || tab.precontent) }}
            </div>
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
            <div class="postcontent" v-if="tab.postcontent"
                :class="[ tab.postcontent.class ]">
                {{ i18n(tab.postcontent.body || tab.postcontent) }}
            </div>
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
