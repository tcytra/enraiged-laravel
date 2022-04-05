<template>
    <div class="vue-form">
        <form class="form" @submit.prevent="submit">
            <slot />
            <div class="actions control">
                <primevue-button class="p-button-primary submit-button" v-if="actions.submit"
                    :disabled="!form.isDirty"
                    :label="actions.submit"
                    @click="$emit('form:submit')" />
                <primevue-button class="p-button-secondary reset-button" v-if="actions.reset && form.isDirty"
                    :label="actions.reset"
                    @click="reset" />
                <primevue-button class="p-button-danger error-button" v-if="actions.clear && form.hasErrors"
                    :label="actions.clear"
                    @click="clear" />
            </div>
        </form>
    </div>
</template>

<script>
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
        form: {
            type: Object,
            required: true,
        },
    },

    computed: {
        actions() {
            return this.builder.actions;
        },
    },

    mounted() {
        this.$emit('form:ready');
    },

    methods: {
        clear() {
            this.form.clearErrors();
            this.$emit('form:clear');
        },
        reset() {
            this.clear();
            this.form.reset();
            this.$emit('form:reset');
        },
    },
};
</script>
