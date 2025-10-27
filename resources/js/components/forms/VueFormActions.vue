<template>
    <div class="actions control" v-if="actions">
        <div class="actions-right gap-2">
            <primevue-button class="submit-button" severity="primary" v-if="actions.store"
                :disabled="!form.isDirty"
                :label="i18n(actions.store.label || 'Save')"
                @click="(submit || form.submit)()"/>
            <primevue-button class="submit-button" severity="success" v-else-if="actions.update"
                :disabled="!form.isDirty"
                :label="i18n(actions.update.label || 'Save')"
                @click="(submit || form.submit)()"/>
            <primevue-button class="reset-button" severity="warn" size="small" v-if="actions.reset && form.isDirty"
                :class="{'fadein': form.isDirty}"
                :label="i18n(actions.reset.label)"
                @click="(reset || form.reset)()"/>
            <primevue-button class="error-button" severity="danger" size="small" v-if="actions.clear && form.hasErrors"
                :class="{'fadein': form.hasErrors}"
                :label="i18n(actions.clear.label)"
                @click="(clear || form.clear)()"/>
        </div>
        <div class="actions-left">
            <primevue-button class="p-button-secondary back-button" severity="secondary" v-if="actions.back"
                :label="i18n(actions.back.label)"
                @click="back"/>
        </div>
    </div>
</template>

<script>
import { trans as i18n } from 'laravel-vue-i18n';
import PrimevueButton from 'primevue/button';

export default {
    components: {
        PrimevueButton,
    },

    props: {
        clear: {
            type: Function,
            default: null,
        },
        form: {
            type: Object,
            required: true,
        },
        reset: {
            type: Function,
            default: null,
        },
        submit: {
            type: Function,
            default: null,
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
        i18n() {
            return i18n;
        },
    },

    methods: {
        back() {
            window.history.back();
        },
    },
};
</script>
