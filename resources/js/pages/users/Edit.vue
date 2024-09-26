<template>
    <main class="content main">
        <page-header back-button fixed :actions="actions" :heading="heading" :title="title"/>
        <section class="auto-margin container max-width-xl">
            <page-messages :messages="messages" @dismiss="messages.splice($event, 1)"/>
            <div class="grid">
                <div class="col-12 xl:col-5">
                    <avatar-editor :avatar="avatar"/>
                    <theme-editor :resource="template.resource" :user="user"/>
                    <locale-editor :resource="template.resource" :user="user"/>
                    <timezone-editor :resource="template.resource" :user="user"/>
                </div>
                <div class="col-12 xl:col-7">
                    <update-form ref="updateUser" custom-actions updating :template="template"/>
                </div>
            </div>
        </section>
        <footer class="footer" v-if="template.actions && Object.keys(template.actions).length">
            <form-actions v-if="ready"
                :form="userForm"
                :template="template"/>
        </footer>
    </main>
</template>

<script>
import App from '@/layouts/App.vue';
import AvatarEditor from '@/components/users/cards/AvatarEditor.vue';
import FormActions from '@/components/forms/VueFormActions.vue';
import LocaleEditor from '@/components/users/cards/LocaleEditor.vue';
import PageHeader from '@/components/ui/pages/PageHeader.vue';
import PageMessages from '@/components/ui/pages/PageMessages.vue';
import ThemeEditor from '@/components/users/cards/ThemeEditor.vue';
import TimezoneEditor from '@/components/users/cards/TimezoneEditor.vue';
import UpdateForm from '@/components/users/forms/UpdateForm.vue';

export default {
    layout: App,

    components: {
        AvatarEditor,
        FormActions,
        LocaleEditor,
        PageHeader,
        PageMessages,
        ThemeEditor,
        TimezoneEditor,
        UpdateForm,
    },

    inject: ['i18n'],

    props: {
        actions: {
            type: Object,
            required: true,
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
        userForm() {
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
