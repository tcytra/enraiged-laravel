<template>
    <app-state :api="uri">
        <template v-slot:default="{}">
            <transition enter-active-class="fadein" leave-active-class="fadeout">
                <div id="page" class="guest layout">
                    <div class="container">
                        <slot/>
                    </div>
                </div>
            </transition>
        </template>
    </app-state>
</template>

<script>
import AppState from './renderless/AppState.vue';
import TopNav from '../menus/TopNav.vue';

export default {
    components: {
        AppState,
        TopNav,
    },

    data: () => ({
        uri: '/api/guest/state',
    }),
};
</script>
