<template>
    <div class="vue-form">
        <form @submit.prevent="submit"
            :class="['form', template.class, {'custom-actions': customActions, 'formgrid grid': formGrid}]">
            <slot v-bind="{ form }">
                <vue-form-tabs v-if="template.tabbed"
                    :creating="creating"
                    :form="form"
                    :template="template"
                    :updating="updating"/>
                <vue-form-section v-else-if="Object.keys(sections).length" v-for="(section, key) in sections"
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
import axios from 'axios';
import { inject } from 'vue';
import { router, useForm } from '@inertiajs/vue3';
import VueFormActions from './VueFormActions.vue';
import VueFormFields from './VueFormFields.vue';
import VueFormSection from './VueFormSection.vue';
import VueFormTabs from './VueFormTabs.vue';

export default {
    components: {
        VueFormActions,
        VueFormFields,
        VueFormSection,
        VueFormTabs,
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
        updating: {
            type: Boolean,
            default: false,
        },
    },

    setup (props, { emit }) {
        const errorHandler = inject('errorHandler');
        const isSuccess = inject('isSuccess');
        const flashSuccess = inject('flashSuccess');

        let fields = props.template.referer
            ? {_referer: props.template.referer}
            : {};

        function clear() {
            form.clearErrors();
            emit('form:clear');
        }

        function filter(template, type, custom) {
            let items = {};
            Object.keys(template).forEach((item) => {
                const itemType = template[item].type || 'text';
                const matchCustom = typeof custom === 'undefined' || template[item].custom;
                const matchType = /^not:/.test(type)
                    ? !type.replace('not:', '').split(',').includes(template[item].type)
                    : template[item].type === type;
                if (matchType && matchCustom) {
                    items[item] = template[item];
                }
            });
            return items;
        }

        function flatten(template) {
            Object.keys(template).forEach((item) => {
                const type = template[item].type || 'text';
                if (type === 'section' || type === 'tab') {
                    flatten(template[item].fields);
                } else {
                    fields[item] = ['checkbox', 'switch'].includes(template[item].type)
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
            const { method, uri } = props.template.resource;
            if (props.template.resource.api === true) {
                axios[method](uri, form.data())
                    .then((response) => {
                        const { status, data } = response;
                        if (isSuccess(status) && data.success) {
                            flashSuccess(data.success);
                        }
                        if (data.redirect) {
                            if (data.redirect === 'back') {
                                window.history.go(-1);
                            } else {
                                router.get(data.redirect);
                            }
                        } else {
                            form.defaults();
                        }
                    })
                    .catch((error) => {
                        const { response } = error;
                        const { errors } = response.data;
                        Object.keys(errors).forEach((each) => {
                            errors[each] = errors[each][0];
                        });
                        form.setError(errors);
                        errorHandler(error);
                    });
            } else {
                form[method](uri, {
                    onSuccess: () => emit('form:success', form),
                });
            }
        }

        flatten(props.template.fields);

        const form = useForm(fields);

        emit('form:ready');

        return {
            clear,
            custom: {
                fields: filter(props.template.fields, 'not:section,tab', true),
                sections: filter(props.template.fields, 'section', true),
                tabs: filter(props.template.fields, 'tab', true),
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
