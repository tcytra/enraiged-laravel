<template>
    <div class="fixed flash messages" v-if="messages.length">
        <flash-message v-for="(message, index) in messages"
            :index="index"
            :message="message"
            @destroy="unflash(index)"/>
    </div>
</template>

<script>
import { mapActions, mapState } from 'pinia'
import { FlashMessages } from '@/stores/flashmessages.js';
import FlashMessage from './flash/Message';

export default {
    components: {
        FlashMessage,
    },

    computed: {
        ...mapState(FlashMessages, ['messages']),
    },

    methods: {
        ...mapActions(FlashMessages, ['flash', 'unflash']),
    },

    watch: {
        '$page.props.flash': {
            handler() {
                const flash = this.$page.props.flash;
                if (flash.message) {
                    this.flash(flash.message);
                }
                if (flash.success) {
                    this.flash(flash.success);
                }
            },
            deep: true,
        },
    },
};
</script>
