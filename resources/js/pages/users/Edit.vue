<template>
    <main class="content main">
        <page-header back-button fixed :actions="actions" :heading="heading" :title="title"/>
        <section class="auto-margin container max-width-xl">
            <page-messages :messages="messages" @dismiss="messages.splice($event, 1)"/>
            <update-form ref="updateUser" custom-actions updating :template="template"/>
        </section>
        <footer class="footer">
            <form-actions v-if="ready"
                :actions="template.actions"
                :form="form.form"
                @clear="form.clear"
                @reset="form.reset"
                @submit="form.submit"/>
        </footer>
    </main>
</template>

<script>
import App from '@/layouts/App.vue';
import FormActions from '@/components/forms/VueFormActions.vue';
import PageHeader from '@/components/ui/pages/PageHeader.vue';
import PageMessages from '@/components/ui/pages/PageMessages.vue';
import UpdateForm from '@/components/users/forms/UpdateForm.vue';

export default {
    layout: App,

    components: {
        FormActions,
        PageHeader,
        PageMessages,
        UpdateForm,
    },

    inject: ['i18n'],

    props: {
        actions: {
            type: Array,
            default: [],
        },
        avatar: {
            type: Object,
            required: true,
        },
        messages: {
            type: Array,
            default: [],
        },
        template: {
            type: Object,
            required: true,
        },
        user: {
            type: Object,
            required: true,
        },
    },

    data: () => ({
        ready: false,
    }),

    computed: {
        form() {
            return this.ready
                ? this.$refs.updateUser.$refs.updateForm
                : null;
        },
        heading() {
            return `${this.i18n('Update User')}: ${this.user.profile.name}`;
        },
        title() {
            return this.i18n('Update User');
        },
    },

    mounted() {
        this.ready = true;
    },
};
</script>
