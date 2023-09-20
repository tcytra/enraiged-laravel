<template>
    <div>
        <vue-form-section v-if="Object.keys(sections).length" v-for="(section, key) in sections"
            :creating="creating"
            :form="form"
            :id="key"
            :key="key"
            :section="section"
            :updating="updating">
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
    </div>
</template>

<script>
import VueFormFields from './VueFormFields.vue';
import VueFormSection from './VueFormSection.vue';

export default {
    components: {
        VueFormFields,
        VueFormSection,
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
        tab: {
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
