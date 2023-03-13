<template>
    <div class="actions control" v-if="actions">
        <div class="actions-left">
            <primevue-button class="p-button-secondary back-button" v-if="actions.back"
                :label="i18n(actions.back.label)"
                @click="back"/>
        </div>
        <div class="actions-right">
            <primevue-button class="p-button-primary submit-button" v-if="actions.submit"
                :disabled="!form.isDirty"
                :label="i18n(actions.submit.label)"
                @click="$emit('submit')"/>
            <primevue-button class="p-button-warning reset-button" v-if="actions.reset && form.isDirty"
                :class="{'fadein': form.isDirty}"
                :label="i18n(actions.reset.label)"
                @click="$emit('reset')"/>
            <primevue-button class="p-button-danger error-button" v-if="actions.clear && form.hasErrors"
                :class="{'fadein': form.hasErrors}"
                :label="i18n(actions.clear.label)"
                @click="$emit('clear')"/>
        </div>
    </div>
</template>

<script>
import PrimevueButton from 'primevue/button/Button.vue';

export default {
    components: {
        PrimevueButton,
    },

    inject: ['i18n'],

    props: {
        actions: {
            type: Object,
            required: true,
        },
        form: {
            type: Object,
            required: true,
        },
    },

    methods: {
        back() {
            this.$emit('history:back');
            window.history.go(-1);
        },
    },
};
</script>
