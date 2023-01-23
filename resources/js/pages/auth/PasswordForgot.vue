<template>
    <div class="forgot panel">
        <page-header title="Forgot Password"/>
        <div class="body" v-if="success">
            <div class="container flex-column">
                <p class="text text-center text-xl">An email has been sent to your address.</p>
                <p class="text text-center text-xl">Follow the instructions to reset your password.</p>
            </div>
        </div>
        <div class="body" v-else>
            <form class="form relative" @submit.prevent="submit">
                <vue-text-field class="email" id="email" focus is-large
                    :field="{ placeholder: 'Email', required: true }"
                    :form="form"/>
            </form>
        </div>
        <footer class="footer">
            <div class="submit container"
                :class="{ 'flex-row-reverse': !success }">
                <primevue-button label="Submit" class="p-button-secondary" v-if="!success"
                    @click="submit" />
                <Link class="flex align-items-center" href="/login">
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
import PrimevueButton from 'primevue/button/Button.vue';
import VueTextField from '@/components/forms/fields/TextField.vue';

export default {
    layout: AppLayout,

    components: {
        AppLayout,
        Link,
        PageHeader,
        PrimevueButton,
        VueTextField,
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
