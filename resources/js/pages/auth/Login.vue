<template>
    <Head title="Login" />
    <div class="auth container bg-bluegray-800">
        <div class="login panel bg-white">
            <header class="header text-center bg-bluegray-100 border-bluegray-200 border-bottom-1">
                <h1>Account Login</h1>
            </header>
            <form class="form" @submit.prevent="submit">
                <div class="field control text">
                    <InputText v-model="form.email" type="text" placeholder="Email Address" class="p-inputtext-lg" />
                </div>
                <div class="field control text">
                    <Password v-model="form.password" placeholder="Account Password" class="p-inputtext-lg" toggle-mask />
                </div>
                <div class="field control switch">
                    <label for="form_remember">Remember Me</label>
                    <InputSwitch id="form_remember" v-model="form.remember" />
                </div>
            </form>
            <footer class="footer border-bluegray-200 border-top-1">
                <div class="submit container text-right">
                    <Button label="Submit" class="p-button-secondary" @click="submit" />
                    <Link href="/register" class="">
                        Register Account
                    </Link>
                </div>
            </footer>
        </div>
        <!--
        <main class="main">
            <section class="content">
                content
            </section>
        </main>
        -->
    </div>
</template>

<script>
import { reactive } from 'vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-vue3';
import Button from 'primevue/button';
import InputSwitch from 'primevue/inputswitch';
import InputText from 'primevue/inputtext';
import Password from 'primevue/password';

export default {
    components: {
        Head,
        Link,
        Button,
        InputSwitch,
        InputText,
        Password,
    },
    setup () {
        const form = reactive({
            email: 'tyler.wood@enraiged.dev',
            password: 'letmein!',
            remember: false,
        });

        function submit() {
            Inertia.post('/login', form)
        }

        return { form, submit };
    },
};
</script>
