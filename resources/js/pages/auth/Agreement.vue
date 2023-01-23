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
import { Head } from '@inertiajs/vue3';
import PrimevueButton from 'primevue/button/Button.vue';

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
