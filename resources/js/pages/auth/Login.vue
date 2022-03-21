<template>
    <Head title="Login" />
    <div class="flex items-center justify-center p-6 min-h-screen bg-indigo-800">
        <div class="w-full max-w-md">
            <form class="mt-8 bg-white rounded-lg shadow-xl overflow-hidden" @submit.prevent="login">
                <div class="px-10 py-12">
                    <h1 class="text-center text-3xl font-bold">
                        <logo class="fill-white" width="120" height="28" />
                    </h1>
                    <div class="mt-6 mx-auto w-24 border-b-2" />
                    <text-input class="mt-10" label="Email" type="email" autofocus autocapitalize="off"
                        v-bind:error="form.errors.email"
                        v-model="form.email" />
                    <text-input class="mt-6" label="Password" type="password"
                        v-bind:error="form.errors.password"
                        v-model="form.password" />
                    <label class="flex items-center mt-6 select-none" for="remember">
                        <input id="remember" v-model="form.remember" class="mr-1" type="checkbox" />
                        <span class="text-sm">Remember Me</span>
                    </label>
                </div>
                <div class="flex px-10 py-4 bg-gray-100 border-t border-gray-100">
                    <loading-button class="btn-indigo ml-auto" type="submit"
                        v-bind:loading="form.processing">
                        Login
                    </loading-button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';
import Logo from '@/components/ui/Logo.vue';
import TextInput from '@/components/forms/fields/TextInput';
import LoadingButton from '@/components/forms/buttons/LoadingButton';

export default {
    components: {
        Head,
        LoadingButton,
        Logo,
        TextInput,
    },
    data() {
        return {
            form: this.$inertia.form({
                email: 'tyler.wood@enraiged.dev',
                password: 'letmein!',
                remember: false,
            }),
        }
    },
    methods: {
        login() {
            this.form.post('/login')
        },
    },
};
</script>
