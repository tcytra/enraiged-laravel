<template>
    <div class="fixed flash messages" v-if="messages.length">
        <flash-message v-for="(message, index) in messages"
            :index="index"
            :message="message"
            @destroy="destroyMessage(index)"/>
    </div>
</template>

<script>
import FlashMessage from './flash/Message';

export default {
    components: {
        FlashMessage,
    },

    data: () => ({
        messages: [],
    }),

    methods: {
        destroyMessage(index) {
            this.messages.splice(index, 1);
        },
    },

    watch: {
        '$page.props.flash': {
            handler() {
                const flash = this.$page.props.flash;
                if (flash.message) {
                    this.messages.push(flash.message);
                }
                if (flash.success) {
                    this.messages.push({ severity: 'success', content: flash.success, expiry: 3000 });
                }
            },
            deep: true,
        },
    },
};
</script>
