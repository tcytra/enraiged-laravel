<template>
    <tab-panel :header="tab.name">
        <slot :name="id" v-if="tab.custom" v-bind="{ creating, tab, form, updating }"/>
        <div v-else>
            <header class="header mb-3" v-if="tab.heading"
                :class="[ tab.heading.class ]">
                <span class="text">{{ i18n(tab.heading.body || tab.heading) }}</span>
            </header>
            <div class="precontent mb-3" v-if="tab.precontent"
                :class="[ tab.precontent.class ]">
                {{ i18n(tab.precontent.body || tab.precontent) }}
            </div>
            <vue-form-section v-if="Object.keys(sections).length" v-for="(section, key) in sections"
                :creating="creating"
                :form="form"
                :id="key"
                :key="key"
                :section="section"
                :updating="updating">
                <template v-for="(_, slot) of $slots" v-slot:[slot]="scope">
                    <slot :name="slot" v-bind="scope"/>
                </template>
                <template v-if="section.custom" v-slot:[key]="props">
                    <slot :name="key" v-bind="{ creating, section, form, key, updating }"/>
                </template>
            </vue-form-section>
            <vue-form-fields v-else-if="Object.keys(fields).length"
                :creating="creating"
                :fields="fields"
                :form="form"
                :updating="updating">
                <template v-for="(field, key) in custom.fields" v-slot:[key]="props">
                    <slot :name="key" v-bind="{ creating, field, form, key, updating }"/>
                </template>
            </vue-form-fields>
            <div class="postcontent" v-if="tab.postcontent"
                :class="[ tab.postcontent.class ]">
                {{ i18n(tab.postcontent.body || tab.postcontent) }}
            </div>
        </div>
    </tab-panel>
</template>

<script>
import TabPanel from 'primevue/tabpanel/TabPanel.vue';
import VueFormFields from './VueFormFields.vue';
import VueFormSection from './VueFormSection.vue';

export default {
    components: {
        TabPanel,
        VueFormFields,
        VueFormSection,
    },

    inject: ['i18n'],

    props: {
        creating: {
            type: Boolean,
            default: false,
        },
        form: {
            type: Object,
            required: true,
        },
        id: {
            type: String,
            required: true,
        },
        tab: {
            type: Object,
            required: true,
        },
        updating: {
            type: Boolean,
            default: false,
        },
    },

    computed: {
        custom() {
            return {
                fields: this.filter(this.tab.fields, 'not:section', true),
                sections: this.filter(this.tab.fields, 'section', true),
            };
        },
        fields() {
            return this.filter(this.tab.fields, 'not:section');
        },
        sections() {
            return this.filter(this.tab.fields, 'section');
        },
    },

    methods: {
        filter(template, type, custom) {
            let items = {};
            Object.keys(template).forEach((item) => {
                const itemType = template[item].type || 'text';
                const matchCustom = typeof custom === 'undefined' || template[item].custom;
                const matchType = ((/^not:/.test(type) && template[item].type !== type.replace('not:', '')) 
                    || (!/^not:/.test(type) && template[item].type === type));
                if (matchType && matchCustom) {
                    items[item] = template[item];
                }
            });
            return items;
        },
    },
};
</script>
