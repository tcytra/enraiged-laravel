<template>
    <div class="actions control" v-if="actions">
        <div class="actions-left">
            <primevue-button class="p-button-secondary back-button" v-if="actions.back"
                :label="i18n(actions.back.label)"
                @click="back"/>
        </div>
        <div class="actions-right">
            <primevue-button class="p-button-success submit-button" v-if="actions.submit"
                :disabled="!form.isDirty"
                :label="i18n(actions.submit.label)"
                @click="form.submit()"/>
            <primevue-button class="p-button-warning reset-button" v-if="actions.reset && form.isDirty"
                :class="{'fadein': form.isDirty}"
                :label="i18n(actions.reset.label)"
                @click="form.reset()"/>
            <primevue-button class="p-button-danger error-button" v-if="actions.clear && form.hasErrors"
                :class="{'fadein': form.hasErrors}"
                :label="i18n(actions.clear.label)"
                @click="form.clear()"/>
        </div>
    </div>
</template>

<script>
import PrimevueButton from 'primevue/button/Button.vue';

export default {
    components: {
        PrimevueButton,
    },

    inject: [
        'back',
        'i18n',
    ],

    props: {
        form: {
            type: Object,
            required: true,
        },
        template: {
            type: Object,
            required: true,
        },
    },

    computed: {
        actions() {
            return this.template.actions;
        },
    },
};
</script>
