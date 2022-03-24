<template>
    <Head title="Register" />
    <div class="auth container bg-bluegray-800">
        <div class="login panel bg-white">
            <header class="header text-center bg-bluegray-100 border-bluegray-200 border-bottom-1">
                <h1>Account Registration</h1>
            </header>
            <form class="form" @submit.prevent="submit">
                <text-field is-large class="field control text name" id="first_name"
                    placeholder="Name"
                    :errors="form.errors"
                    :model="form.first_name"
                    @update:value="update"/>
                <text-field is-large class="field control text email" id="email"
                    placeholder="Email"
                    :errors="form.errors"
                    :model="form.email"
                    @update:value="update"/>
                <password-field is-large class="field control text password" id="password" feedback
                    placeholder="Password"
                    :errors="form.errors"
                    :model="form.password"
                    @update:value="update"/>
                <password-field is-large class="field control text password" id="password_confirm"
                    placeholder="Confirm Password"
                    :errors="form.errors"
                    :model="form.password_confirm"
                    @update:value="update"/>
                <switch-field class="field control switch" id="agree"
                    label="I agree to check the box"
                    :errors="form.errors"
                    :model="form.agree"
                    @update:value="update"/>
            </form>
            <footer class="footer border-bluegray-200 border-top-1">
                <div class="submit container text-right">
                    <Button label="Register" class="p-button-secondary" @click="submit" />
                    <Link class="flex align-items-center" href="/login">
                        <i class="pi pi-angle-right"></i>
                        <span>Account Login</span>
                    </Link>
                </div>
            </footer>
        </div>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/inertia-vue3'
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';
import Button from 'primevue/button';
import PasswordField from '@/components/forms/fields/PasswordField.vue';
import SwitchField from '@/components/forms/fields/SwitchField.vue';
import TextField from '@/components/forms/fields/TextField.vue';

export default {
    components: {
        Head,
        Link,
        Button,
        PasswordField,
        SwitchField,
        TextField,
    },
    setup () {
        const form = useForm({
            agree: true,
            email: 'owner@enraiged.dev',
            first_name: 'Enraiged Owner',
            password: 'changeme',
            password_confirm: 'changeme',
        });

        function submit() {
            form.post('/register');
        }

        function update(field) {
            form.clearErrors(field.id);
            form[field.id] = field.value;
        }

        return { form, submit, update };
    },
};
</script>
