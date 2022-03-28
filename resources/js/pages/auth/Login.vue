<template>
    <Head title="Login" />
    <div class="login panel bg-white">
        <header class="header text-center bg-bluegray-100 border-bluegray-200 border-bottom-1">
            <h1>Login</h1>
        </header>
        <div class="body">
            <form class="form relative" @submit.prevent="submit">
                <text-field is-large class="field control text email" id="email"
                    placeholder="Email"
                    :errors="form.errors"
                    :model="form.email"
                    @update:value="update"/>
                <password-field is-large class="field control text password" id="password" toggle-mask
                    placeholder="Password"
                    :errors="form.errors"
                    :model="form.password"
                    @update:value="update"/>
                <switch-field class="field control switch" id="remember"
                    label="Remember Me"
                    :errors="form.errors"
                    :model="form.remember"
                    @update:value="update"/>
            </form>
        </div>
        <footer class="footer border-bluegray-200 border-top-1">
            <div class="submit container flex-row-reverse">
                <Button label="Login" class="p-button-secondary" @click="submit" />
                <div class="flex">
                    <Link href="/register">
                        <span>Register</span>
                    </Link>
                    &nbsp; &bull; &nbsp;
                    <Link href="/forgot-password">
                        <span>Forgot Password</span>
                    </Link>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
import AppLayout from '@/layouts/App.vue';
import { useForm } from '@inertiajs/inertia-vue3'
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';
import Button from 'primevue/button';
import PasswordField from '@/components/forms/fields/PasswordField.vue';
import SwitchField from '@/components/forms/fields/SwitchField.vue';
import TextField from '@/components/forms/fields/TextField.vue';

export default {
    layout: AppLayout,
    components: {
        Head,
        Link,
        Button,
        PasswordField,
        SwitchField,
        TextField,
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
