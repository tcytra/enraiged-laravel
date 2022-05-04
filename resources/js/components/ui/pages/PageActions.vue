<template>
    <div class="actions">
        <div class="action" v-for="(action, index) in actions" :key="index"
            @click="click(action)">
            <primevue-button class="button"
                :class="action.class"
                :icon="action.icon"
                :label="action.label"/>
        </div>
        <div class="action go-back" v-if="backButton && history" @click="back()">
            <primevue-button class="button p-button-info p-button-text"
                icon="pi pi-sync"
                label="Back"/>
        </div>
    </div>
</template>

<script>
import PrimevueButton from 'primevue/button';

export default {
    components: {
        PrimevueButton,
    },

    props: {
        actions: {
            type: Object,
            default: {},
        },
        backButton: {
            type: Boolean,
            default: false,
        },
    },

    computed: {
        history() {
            return window.history.length > 0;
        },
    },

    methods: {
        back() {
            window.history.go(-1);
        },
        click(action) {
            this.$inertia.get(action.uri);
        },
    },
};
</script>
