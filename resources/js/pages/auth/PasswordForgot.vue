<template>
    <Head title="Forgot Password" />
    <div class="forgot panel">
        <header class="header text-center">
            <h1>Forgot Password</h1>
        </header>
        <div class="body" v-if="success">
            <div class="container flex-column">
                <p class="text text-center text-xl">An email has been sent to your address.</p>
                <p class="text text-center text-xl">Follow the instructions to reset your password.</p>
            </div>
        </div>
        <div class="body" v-else>
            <form class="form relative" @submit.prevent="submit">
                <vue-text-field focus is-large class="email" id="email"
                    placeholder="Email"
                    :form="form"
                    :model="form.email"/>
            </form>
        </div>
        <footer class="footer">
            <div class="submit container"
                :class="{ 'flex-row-reverse': !success }">
                <primevue-button label="Submit" class="p-button-secondary" v-if="!success"
                    @click="submit" />
                <Link class="flex align-items-center" href="/login">
                    <span>Login</span>
                </Link>
            </div>
        </footer>
    </div>
</template>

<script>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import AppLayout from '@/layouts/App.vue';
import PrimevueButton from 'primevue/button';
import VueTextField from '@/components/forms/fields/TextField.vue';

export default {
    layout: AppLayout,

    components: {
        AppLayout,
        Head,
        Link,
        PrimevueButton,
        VueTextField,
    },

    props: {
        flash: Object,
        form: Object,
    },

    computed: {
        success() {
            return this.flash && this.flash.status === 200;
        },
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
