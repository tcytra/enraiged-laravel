<template>
    <div class="vue-form">
        <form @submit.prevent="submit"
            :class="['form', template.class, labels, {'custom-actions': customActions, 'formgrid grid': formGrid}]">
            <slot v-bind="{ form }">
                <vue-form-section v-if="sections" v-for="(section, key) in sections"
                    :creating="creating"
                    :form="form"
                    :id="key"
                    :key="key"
                    :section="section"
                    :updating="updating">
                    <template v-if="section.custom" v-slot:[key]="props">
                        <slot :name="key" v-bind="{ creating, labels, section, form, key, updating }"/>
                    </template>
                </vue-form-section>
                <vue-form-fields v-if="fields"
                    :creating="creating"
                    :fields="fields"
                    :form="form"
                    :updating="updating">
                    <template v-for="(field, key) in custom.fields" v-slot:[key]="props">
                        <slot :name="key" v-bind="{ creating, field, form, key, updating }"/>
                    </template>
                </vue-form-fields>
            </slot>
            <vue-form-actions v-if="!customActions"
                :actions="template.actions"
                :form="form"
                @clear="clear"
                @reset="reset"
                @submit="submit"/>
        </form>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/vue3';
import VueFormActions from './VueFormActions.vue';
import VueFormFields from './VueFormFields.vue';
import VueFormSection from './VueFormSection.vue';

export default {
    components: {
        VueFormActions,
        VueFormFields,
        VueFormSection,
    },

    props: {
        creating: {
            type: Boolean,
            default: false,
        },
        customActions: {
            type: Boolean,
            default: false,
        },
        formGrid: {
            type: Boolean,
            default: false,
        },
        template: {
            type: Object,
            required: true,
        },
        toggleLabels: {
            type: Boolean,
            default: false,
        },
        updating: {
            type: Boolean,
            default: false,
        },
    },

    computed: {
        labels() {
            return this.template.labels === false
                ? null
                : this.template.labels || 'vertical';
        },
    },

    setup (props, { emit }) {
        let fields = {};

        function clear() {
            form.clearErrors();
            emit('form:clear');
        }

        function filter(template, type, custom) {
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
        }

        function flatten(template) {
            Object.keys(template).forEach((item) => {
                const type = template[item].type || 'text';
                if (type === 'section') {
                    flatten(template[item].fields);
                } else {
                    if (template[item].type === 'calendar'
                        && template[item].value
                        && template[item].value.toString().match(/^\d{4}-\d{2}-\d{2}$/)) {
                        template[item].value = new Date(`${template[item].value} 00:00:00`);
                    }
                    fields[item] = template[item].type === 'switch'
                        ? template[item].value && template[item].value === true
                        : template[item].value || null;
                }
            });
            return fields;
        }

        function reset() {
            form.clearErrors();
            form.reset();
            emit('form:reset');
        }

        function submit() {
            form[props.template.resource.method](props.template.uri, {
                onSuccess: () => emit('form:success', form),
            });
            emit('form:submit');
        }

        flatten(props.template.fields);

        const form = useForm(fields);

        emit('form:ready');

        return {
            clear,
            custom: {
                fields: filter(props.template.fields, 'not:section', true),
                sections: filter(props.template.fields, 'section', true),
            },
            fields: filter(props.template.fields, 'not:section'),
            form,
            reset,
            sections: filter(props.template.fields, 'section'),
            submit,
        };
    },
};
</script>
