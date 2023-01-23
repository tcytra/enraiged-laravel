<template>
    <div class="fixed flash messages" v-if="messages.length">
        <flash-message v-for="(message, index) in messages"
            :index="index"
            :message="message"
            @unflash="$emit('unflash', index)"/>
    </div>
</template>

<script>
import FlashMessage from './flash/Message.vue';

export default {
    components: {
        FlashMessage,
    },

    props: {
        messages: {
            type: Array,
            default: [],
        },
    },
};
</script>
