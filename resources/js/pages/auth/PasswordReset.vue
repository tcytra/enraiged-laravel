<template>
    <div class="login panel">
        <page-header title="Reset Password"/>
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
                <vue-text-field is-large class="email" id="email"
                    :field="{ placeholder: 'Email', required: true }"
                    :form="form"/>
                <vue-password-field is-large feedback id="password"
                    :field="{ placeholder: 'Password', required: true }"
                    :form="form"/>
                <vue-password-field is-large id="password_confirmation"
                    :field="{ placeholder: 'Confirm Password', required: true }"
                    :form="form"/>
            </form>
        </div>
        <footer class="footer">
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
// import { toRefs } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/App.vue';
import PageHeader from '@/components/ui/pages/PageHeader.vue';
import PrimevueButton from 'primevue/button/Button.vue';
import VuePasswordField from '@/components/forms/fields/PasswordField.vue';
import VueTextField from '@/components/forms/fields/TextField.vue';

export default {
    layout: AppLayout,

    components: {
        AppLayout,
        Link,
        PageHeader,
        PrimevueButton,
        VuePasswordField,
        VueTextField,
    },

    props: {
        flash: Object,
        form: {
            type: Object,
            required: true,
        },
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

        return { form, submit };
    },
};
</script>
