<template>
    <app-state :api="uri">
        <template v-slot:default="{ ready }">
            <transition enter-active-class="fadein" leave-active-class="fadeout">
                <div id="page" class="guest layout" v-if="ready">
                    <div class="container">
                        <slot />
                    </div>
                </div>
                <div class="default overlay" key="overlay" v-else>
                    <vue-progress-spinner/>
                </div>
            </transition>
        </template>
    </app-state>
</template>

<script>
import AppState from './renderless/AppState.vue';
import VueProgressSpinner from 'primevue/progressspinner/ProgressSpinner.vue';

export default {
    components: {
        AppState,
        VueProgressSpinner,
    },

    data: () => ({
        uri: '/api/guest/state',
    }),
};
</script>
