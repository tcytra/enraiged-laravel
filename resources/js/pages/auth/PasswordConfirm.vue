<template>
    <main class="main content">
        <page-header title="Confirm Password"/>
        <div class="container p-3 flex align-items-center justify-content-center">
            <primevue-panel class="col-12 md:col-10 lg:col-8 confirm password"
                :header="i18n('Confirm Password')">
                <form class="form relative" @submit.prevent="submit">
                    <aside class="aside mb-5 text">
                        <strong>
                            {{ i18n('This action is secure.') }}
                            <br>
                            {{ i18n('Please confirm your user password to proceed.') }}
                        </strong>
                    </aside>
                    <div class="center-x-small column container fields mb-5">
                        <vue-password-field class="horizontal m-0" id="password" focus toggle-mask
                            :field="{ placeholder: 'Password', required: true }"
                            :form="form"/>
                    </div>
                    <div class="button center-x-small column container mb-3">
                        <div class="button control">
                            <primevue-button class="p-button-secondary"
                                :label="i18n('Please confirm')"
                                @click="submit"/>
                        </div>
                    </div>
                </form>
            </primevue-panel>
        </div>
    </main>
</template>

<script>
import { useForm } from '@inertiajs/vue3'
import AppLayout from '@/layouts/App.vue';
import PageHeader from '@/components/ui/pages/PageHeader.vue';
import PrimevueButton from 'primevue/button/Button.vue';
import PrimevuePanel from 'primevue/panel/Panel.vue';
import VuePasswordField from '@/components/forms/fields/PasswordField.vue';

export default {
    layout: AppLayout,

    components: {
        PageHeader,
        PrimevueButton,
        PrimevuePanel,
        VuePasswordField,
    },

    inject: ['i18n'],

    props: {
        form: Object,
    },

    setup (props) {
        const form = useForm(props.form.fields);

        function submit() {
            form.post(props.form.uri);
        }

        function update(field) {
            form.clearErrors(field.id);
            form[field.id] = field.value;
        }

        return { form, submit, update };
    },
};
</script>

<style>
    .confirm.password.p-panel {
        margin-bottom: 10rem;
        margin-top: -10rem;
        max-width: 40rem;
        min-width: 32rem;
    }
</style>
