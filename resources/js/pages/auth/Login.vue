<template>
    <Head title="Login" />
    <div class="login panel">
        <header class="header text-center">
            <h1>Login</h1>
        </header>
        <div class="body">
            <form class="form relative" @submit.prevent="submit">
                <vue-text-field class="email" id="email" is-large
                    :field="{ placeholder: 'Email', required: true }"
                    :form="form"/>
                <vue-password-field id="password" feedback is-large toggle-mask
                    :field="{ placeholder: 'Password', required: true }"
                    :form="form"/>
                <vue-switch-field id="remember"
                    :field="{ label: 'Remember Me' }"
                    :form="form"/>
            </form>
        </div>
        <footer class="footer">
            <div class="submit container flex-row-reverse">
                <primevue-button label="Login" class="p-button-secondary" @click="submit" />
                <div class="flex">
                    <span v-if="$page.props.meta.allow_registration">
                        <Link href="/register">
                            <span>Register</span>
                        </Link>
                        &nbsp; &bull; &nbsp;
                    </span>
                    <span>
                        <Link href="/forgot-password">
                            <span>Forgot Password</span>
                        </Link>
                    </span>
                </div>
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
        form: {
            type: Object,
            required: true,
        },
    },

    setup (props) {
        const form = useForm(props.form.fields);

        function submit() {
            form.post(props.form.uri);
        }

        return { form, submit };
    },
};
</script>
