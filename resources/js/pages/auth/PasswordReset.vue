<template>
    <Head title="Register" />
    <div class="login panel bg-white">
        <header class="header text-center bg-bluegray-100 border-bluegray-200 border-bottom-1">
            <h1>Reset Password</h1>
        </header>
        <div class="body" v-if="success">
            <div class="container flex-column">
                <p class="text text-center text-xl">Your password has been reset.</p>
                <div class="text-center my-5">
                    <Link as="button" class="p-button p-button-secondary" href="/login" type="button">
                        Return to login
                    </Link>
                </div>
            </div>
        </div>
        <div class="body" v-else>
            <form class="form relative" @submit.prevent="submit">
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
                <password-field is-large class="field control text password" id="password_confirmation"
                    placeholder="Confirm Password"
                    :errors="form.errors"
                    :model="form.password_confirmation"
                    @update:value="update"/>
            </form>
        </div>
        <footer class="footer border-bluegray-200 border-top-1">
            <div class="submit container"
                :class="{ 'flex-row-reverse': !success }">
                <primevue-button label="Reset Password" class="p-button-secondary" v-if="!success"
                    @click="submit"/>
                <Link class="flex align-items-center" href="/login">
                    <span>Login</span>
                </Link>
            </div>
        </footer>
    </div>
</template>

<script>
import AppLayout from '@/layouts/App.vue';
import { toRefs } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3'
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';
import PasswordField from '@/components/forms/fields/PasswordField.vue';
import TextField from '@/components/forms/fields/TextField.vue';
import PrimevueButton from 'primevue/button';

export default {
    layout: AppLayout,
    components: {
        AppLayout,
        Head,
        Link,
        PasswordField,
        PrimevueButton,
        TextField,
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
