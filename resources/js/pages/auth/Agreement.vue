<template>
    <div class="guest layout">
        <Head :title="type"/>
        <div class="container bg-bluegray-800">
            <div class="agreement panel">
                <div class="text-100" v-html="agreement.content"/>
                <!--<div class="action close">
                    <primevue-button icon="pi pi-times" class="p-button-rounded p-button-danger" @click="window.close()"/>
                </div>-->
            </div>
        </div>
    </div>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';
import PrimevueButton from 'primevue/button';

export default {
    components: {
        Head,
        PrimevueButton,
    },

    props: {
        agreement: {
            type: Object,
            required: true,
        },
    },

    computed: {
        type() {
            return this.agreement.type;
        },
    },
};    
</script>

<style lang="scss">
#app .agreement.panel {
    .action.close {
        position: fixed;
        top: 1rem;
        right: 1rem;
    }

    h1, h2, h3, h4, p, ol, ul {
        margin-bottom: 1rem;
        margin-top: 1rem;
    }
}
</style>
