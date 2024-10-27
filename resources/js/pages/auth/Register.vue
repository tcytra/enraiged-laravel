<template>
    <div class="login panel">
        <page-header :title="title"/>
        <div class="body" v-if="success">
            <div class="container flex-column">
                <p class="text-lg my-3">
                    {{ i18n('Your account details have been successfully registered!') }}
                </p>
                <p class="text-lg my-3">
                    {{ i18n('Please check your inbox for a verification email and follow the provided instructions.') }}
                </p>
            </div>
        </div>
        <div class="body" v-else>
            <form class="form relative" @submit.prevent="submit">
                <vue-text-field class="name" id="name" is-large
                    :field="{ placeholder: 'Name', required: true }"
                    :form="form"/>
                <vue-text-field class="email" id="email" is-large
                    :field="{ placeholder: 'Email', required: true }"
                    :form="form"/>
                <vue-password-field id="password" feedback is-large
                    :field="{ placeholder: 'Password', required: true }"
                    :form="form"/>
                <vue-password-field id="password_confirmation" is-large
                    :field="{ placeholder: 'Confirm Password', required: true }"
                    :form="form"/>
                <agreement-switch-field id="agree"
                    :form="form"/>
            </form>
        </div>
        <footer class="footer">
            <div class="submit container"
                :class="{ 'flex-row-reverse': !success }">
                <primevue-button label="Register" class="p-button-secondary" v-if="!success"
                @click="submit"/>
                <Link class="flex align-items-center" href="/login">
                    <!--<i class="pi pi-angle-right"></i>-->
                    <span>Login</span>
                </Link>
            </div>
        </footer>
    </div>
</template>

<script>
import { Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/App.vue';
import PageHeader from '@/components/ui/pages/PageHeader.vue';
import PrimevueButton from 'primevue/button';
import VuePasswordField from '@/components/forms/fields/PasswordField.vue';
import VueTextField from '@/components/forms/fields/TextField.vue';
import AgreementSwitchField from '@/components/users/forms/fields/AgreementSwitchField.vue';

export default {
    layout: AppLayout,

    components: {
        Link,
        PageHeader,
        PrimevueButton,
        VuePasswordField,
        VueTextField,
        AgreementSwitchField,
    },

    props: {
        flash: Object,
        form: Object,
    },

    inject: ['i18n'],

    computed: {
        success() {
            return this.flash && this.flash.status === 201;
        },
        title() {
            return this.success
                ? 'Registration Successful'
                : 'Register Account';
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
