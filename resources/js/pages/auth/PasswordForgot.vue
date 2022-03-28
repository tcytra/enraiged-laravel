<template>
    <Head title="Forgot Password" />
    <div class="forgot panel bg-white">
        <header class="header text-center bg-bluegray-100 border-bluegray-200 border-bottom-1">
            <h1>Forgot Password</h1>
        </header>
        <div class="body" v-if="success"
            :class="{ 'fade-in': success }">
            <div class="container flex-column">
                <p class="text text-center text-xl">An email has been sent to your address.</p>
                <p class="text text-center text-xl">Follow the instructions to reset your password.</p>
            </div>
        </div>
        <div class="body" v-else>
            <form class="form relative" @submit.prevent="submit">
                <text-field is-large class="field control text email" id="email"
                    placeholder="Email"
                    :errors="form.errors"
                    :model="form.email"
                    @update:value="update"/>
            </form>
        </div>
        <footer class="footer border-bluegray-200 border-top-1">
            <div class="submit container flex-row-reverse">
                <primevue-button label="Submit" class="p-button-secondary"
                    :disabled="success"
                    @click="submit" />
                <Link class="flex align-items-center" href="/login">
                    <span>Login</span>
                </Link>
            </div>
        </footer>
    </div>
</template>

<script>
import AppLayout from '@/layouts/App.vue';
import { useForm } from '@inertiajs/inertia-vue3'
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';
import PrimevueButton from 'primevue/button';
import TextField from '@/components/forms/fields/TextField.vue';

export default {
    layout: AppLayout,
    components: {
        AppLayout,
        Head,
        Link,
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
