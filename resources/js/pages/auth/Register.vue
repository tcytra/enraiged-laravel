<template>
    <Head title="Register" />
    <div class="login panel">
        <header class="header text-center">
            <h1>Register</h1>
        </header>
        <div class="body" v-if="success">
            <div class="container flex-column">
                <p class="text text-center text-xl">Your email address must be verified.</p>
                <p class="text text-center text-xl">Please check your inbox for an email.</p>
            </div>
        </div>
        <div class="body" v-else>
            <form class="form relative" @submit.prevent="submit">
                <vue-text-field is-large class="name" id="name"
                    placeholder="Name"
                    :form="form"
                    :model="form.name"/>
                <vue-text-field is-large class="email" id="email"
                    placeholder="Email"
                    :form="form"
                    :model="form.email"/>
                <vue-password-field is-large feedback id="password"
                    placeholder="Password"
                    :form="form"
                    :model="form.password"/>
                <vue-password-field is-large id="password_confirmation"
                    placeholder="Confirm Password"
                    :form="form"
                    :model="form.password_confirmation"/>
                <vue-switch-field id="agree"
                    label="I agree to check the box"
                    :form="form"
                    :model="form.agree"/>
            </form>
        </div>
        <footer class="footer">
            <div class="submit container"
                :class="{ 'flex-row-reverse': !success }">
                <primevue-button label="Register" class="p-button-secondary" v-if="!success"
                @click="submit" />
                <Link class="flex align-items-center" href="/login">
                    <!--<i class="pi pi-angle-right"></i>-->
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
import VuePasswordField from '@/components/forms/fields/PasswordField.vue';
import VueSwitchField from '@/components/forms/fields/SwitchField.vue';
import VueTextField from '@/components/forms/fields/TextField.vue';

export default {
    layout: AppLayout,

    components: {
        Head,
        Link,
        PrimevueButton,
        VuePasswordField,
        VueSwitchField,
        VueTextField,
    },

    props: {
        flash: Object,
        form: Object,
    },

    computed: {
        success() {
            return this.flash && this.flash.status === 201;
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
