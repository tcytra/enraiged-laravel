<template>
    <Head title="Confirm Password" />
    <main class="main content">
        <div class="container p-3 flex align-items-center justify-content-center">
            <primevue-panel header="Confirm Password" class="col-12 md:col-10 lg:col-8 confirm password">
                <form class="form relative" @submit.prevent="submit">
                    <aside class="aside mb-5 text">
                        <strong>This action is secure.<br>Please confirm your account password to proceed.</strong>
                    </aside>
                    <div class="center-x-small column container fields">
                        <vue-password-field class="m-0" id="password"
                            focus
                            toggle-mask
                            placeholder="Password"
                            :form="form"
                            :model="form.password"/>
                    </div>
                    <div class="button center-x-small column container mb-3">
                        <div class="button control">
                            <primevue-button label="Confirm" class="p-button-secondary" @click="submit" />
                        </div>
                    </div>
                </form>
            </primevue-panel>
        </div>
    </main>
</template>

<script>
import AppLayout from '@/layouts/App.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3'
import PrimevueButton from 'primevue/button';
import PrimevuePanel from 'primevue/panel';
import VuePasswordField from '@/components/forms/fields/PasswordField.vue';

export default {
    layout: AppLayout,

    components: {
        Head,
        PrimevueButton,
        PrimevuePanel,
        VuePasswordField,
    },

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
