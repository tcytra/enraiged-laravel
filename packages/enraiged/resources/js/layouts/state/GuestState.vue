<template>
    <core-state :api="uri">
        <template v-slot:default="{ appReady }">
            <div class="guest layout" v-if="appReady">
                <div class="container bg-bluegray-800">
                    <slot />
                </div>
            </div>
        </template>
    </core-state>
</template>

<script>
import CoreState from './renderless/CoreState';

export default {
    components: {
        CoreState,
    },

    data: () => ({
        uri: '/api/guest/state',
    }),
};
</script>
