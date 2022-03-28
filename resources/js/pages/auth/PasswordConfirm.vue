<template>
    <Head title="Confirm Password" />
    <main class="main content">
        <div class="container p-3 flex align-items-center justify-content-center">
            <primevue-panel header="Confirm Password" class="col-12 md:col-10 lg:col-8 confirm password">
                <form class="form relative" @submit.prevent="submit">
                    <aside class="aside mb-5 text">
                        <strong>This action is secure.<br>Please confirm your account password to proceed.</strong>
                    </aside>
                    <div class="center-x-small column container fields my-3">
                        <password-field class="field control text password" id="password"
                            toggle-mask
                            placeholder="Password"
                            :errors="form.errors"
                            :model="form.password"
                            @update:value="update"/>
                    </div>
                    <div class="button center-x-small container reverse row mb-3">
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
import { useForm } from '@inertiajs/inertia-vue3'
import { Head } from '@inertiajs/inertia-vue3';
import PasswordField from '@/components/forms/fields/PasswordField.vue';
import PrimevueButton from 'primevue/button';
import PrimevuePanel from 'primevue/panel';

export default {
    layout: AppLayout,
    components: {
        Head,
        PasswordField,
        PrimevueButton,
        PrimevuePanel,
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
        max-width: 40rem;
        min-width: 32rem;
    }
</style>
