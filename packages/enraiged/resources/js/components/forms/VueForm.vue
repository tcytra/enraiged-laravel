<template>
    <div class="vue-form">
        <div class="controls flex flex-row-reverse" v-if="builder.labels === 'toggle'">
            <div class="align-items-center control flex switch mb-1">
                <primevue-switch v-model="labelsToggle" id="toggle_labels"/>
            </div>
        </div>
        <form @submit.prevent="submit"
            :class="['form', labels, {'custom-actions': customActions}]">
            <slot v-bind:form="form" v-if="ready"/>
            <form-actions v-if="!customActions"
                :actions="builder.actions"
                :form="form"
                @clear="clear"
                @reset="reset"
                @submit="submit"/>
        </form>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/inertia-vue3';
import FormActions from './controls/FormActions.vue';
import PrimevueButton from 'primevue/button';
import PrimevueSwitch from 'primevue/inputswitch';

export default {
    components: {
        FormActions,
        PrimevueButton,
        PrimevueSwitch,
    },

    inject: ['i18n'],

    props: {
        builder: {
            type: Object,
            required: true,
        },
        customActions: {
            type: Boolean,
            default: false,
        },
    },

    data: () => ({
        labelsToggle: true,
        ready: false,
    }),

    computed: {
        actions() {
            return this.builder.actions;
        },
        labels() {
            if (this.builder.labels === false) {
                return null;
            }
            if (this.builder.labels === 'toggle') {
                return this.labelsToggle ? 'horizontal' : 'vertical';
            }
            return this.builder.labels || 'vertical';
        },
    },

    mounted() {
        this.ready = true;
        this.$emit('form:ready');
    },

    setup (props, { emit }) {
        let fields = {};

        flatten(props.builder.fields);

        const form = useForm(fields);

        function clear() {
            form.clearErrors();
            emit('clear');
        }

        function flatten(group) {
            Object.keys(group).forEach((field) => {
                const type = group[field].type || 'input';
                if (['group', 'section'].includes(type) && group[field].fields) {
                    flatten(group[field].fields);
                } else {
                    fields[field] = group[field].type === 'switch'
                        ? group[field].value && group[field].value === true
                        : group[field].value || null;
                }
            });
        }

        function reset() {
            clear();
            form.reset();
            emit('reset');
        }

        function submit() {
            form[props.builder.resource.method](props.builder.uri, {
                onSuccess: () => {
                    form.reset('password', 'password_confirmation');
                    emit('form:success', form);
                }
            });
            emit('submit');
        }

        return { clear, flatten, form, reset, submit };
    },
};
</script>
