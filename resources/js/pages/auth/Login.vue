<template>
    <Head title="Login" />
    <div class="auth container bg-bluegray-800">
        <div class="login panel bg-white">
            <header class="header text-center bg-bluegray-100 border-bluegray-200 border-bottom-1">
                <h1>Account Login</h1>
            </header>
            <form class="form" @submit.prevent="submit">
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
            <footer class="footer border-bluegray-200 border-top-1">
                <div class="submit container text-right">
                    <Button label="Login" class="p-button-secondary" @click="submit" />
                    <Link class="flex align-items-center" href="/register">
                        <i class="pi pi-angle-right"></i>
                        <span>Register Account</span>
                    </Link>
                </div>
            </footer>
        </div>
    </div>
</template>

<script>
import { reactive } from 'vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
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
        const form = reactive({
            email: 'administrator@enraiged.dev',
            password: 'letmein!',
            remember: false,
        });

        function submit() {
            Inertia.post('/login', form)
        }

        function update(field) {
            form.clearErrors(field.id);
            form[field.id] = field.value;
        }

        return { form, submit, update };
    },
};
</script>
