<template>
    <div class="login panel">
        <page-header title="User Login"/>
        <div class="body">
            <form class="form relative" @submit.prevent="submit">
                <vue-text-field class="email" id="email" is-large
                    :field="{ placeholder: 'Email', required: true }"
                    :form="form"/>
                <vue-password-field id="password" is-large
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
                    <span v-if="meta.allow_registration">
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
import { Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/App.vue';
import PageHeader from '@/components/ui/pages/PageHeader.vue';
import PrimevueButton from 'primevue/button/Button.vue';
import VuePasswordField from '@/components/forms/fields/PasswordField.vue';
import VueSwitchField from '@/components/forms/fields/SwitchField.vue';
import VueTextField from '@/components/forms/fields/TextField.vue';

export default {
    layout: AppLayout,

    components: {
        Link,
        PageHeader,
        PrimevueButton,
        VuePasswordField,
        VueSwitchField,
        VueTextField,
    },

    inject: ['meta'],

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
