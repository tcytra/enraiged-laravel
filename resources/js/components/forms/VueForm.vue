<template>
    <div class="vue-form">
        <form class="form" @submit.prevent="submit">
            <slot v-if="ready"/>
            <div class="actions control">
                <primevue-button class="p-button-primary submit-button" v-if="actions.submit"
                    :disabled="!form.isDirty"
                    :label="actions.submit.label"
                    @click="submit"/>
                <primevue-button class="p-button-secondary reset-button" v-if="actions.reset && form.isDirty"
                    :label="actions.reset.label"
                    @click="reset"/>
                <primevue-button class="p-button-danger error-button" v-if="actions.clear && form.hasErrors"
                    :label="actions.clear.label"
                    @click="clear"/>
            </div>
        </form>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/inertia-vue3';
import PrimevueButton from 'primevue/button';

export default {
    components: {
        PrimevueButton,
    },

    props: {
        builder: {
            type: Object,
            required: true,
        },
    },

    data: () => ({
        ready: false,
    }),

    computed: {
        actions() {
            return this.builder.actions;
        },
    },

    mounted() {
        this.ready = true;
        this.$emit('form:ready');
    },

    setup (props) {
        let fields = {};

        flatten(props.builder.fields);

        const form = useForm(fields);

        function clear() {
            form.clearErrors();
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
        }

        function submit() {
            form[props.builder.resource.method](props.builder.uri, {
                onSuccess: () => {
                    form.reset('password', 'password_confirmation');
                }
            });
        }

        return { clear, form, reset, submit };
    },
};
</script>
