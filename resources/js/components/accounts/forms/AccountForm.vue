<template>
    <div class="account-form adjacent-labels">
        <primevue-card class="mb-3">
            <template #content>
                <vue-form ref="accountForm"
                    :builder="builder"
                    :form="form"
                    @form:ready="$emit('form:ready')"
                    @form:submit="submit">
                    <section class="personal section">
                        <h3 class="h3">
                            Personal Information
                        </h3>
                        <vue-dropdown-field id="salut" label="Salutation" placeholder="Optional" show-clear
                            :form="form"
                            :model="form.salut"
                            :options="builder.options.salut"/>
                        <vue-text-field id="first_name" label="First Name" placeholder="Required"
                            :form="form"
                            :model="form.first_name"/>
                        <vue-text-field id="last_name" label="Last Name" placeholder="Required"
                            :form="form"
                            :model="form.last_name"/>
                        <vue-text-field id="phone" label="Phone" placeholder="Optional"
                            :form="form"
                            :model="form.phone"/>
                    </section>
                    <section class="authorization section">
                        <h3 class="h3">
                            Login Details
                        </h3>
                        <vue-text-field class="email" id="email" label="Primary Email" placeholder="Required"
                            :form="form"
                            :model="form.email"/>
                        <vue-text-field id="username" label="Secondary Email" placeholder="Optional"
                            :form="form"
                            :model="form.username"/>
                        <vue-password-field feedback id="password" label="Password" placeholder="Leave blank to keep password"
                            :form="form"
                            :model="form.password"/>
                        <vue-password-field id="password_confirmation" label="Confirm Password"
                            :form="form"
                            :model="form.password_confirmation"/>
                    </section>
                </vue-form>
            </template>
        </primevue-card>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/inertia-vue3';
import PrimevueCard from 'primevue/card';
import VueDropdownField from '@/components/forms/fields/DropdownField.vue';
import VueForm from '@/components/forms/VueForm';
import VuePasswordField from '@/components/forms/fields/PasswordField.vue';
import VueTextField from '@/components/forms/fields/TextField.vue';

export default {
    components: {
        PrimevueCard,
        VueDropdownField,
        VueForm,
        VuePasswordField,
        VueTextField,
    },

    props: {
        builder: {
            type: Object,
            required: true,
        },
    },

    setup (props) {
        const form = useForm(props.builder.fields);

        function submit() {
            form.patch(props.builder.resource.uri, {
                onSuccess: () => form.reset('password', 'password_confirmation'),
            });
        }

        return { form, submit };
    },
};
</script>
