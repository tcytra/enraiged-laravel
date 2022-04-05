<template>
    <primevue-message class="message" ref="message"
        :class="{ 'fade-out': fadeOut }"
        :index="index"
        :severity="message.severity"
        :sticky="true"
        @mouseenter="fadeOut = false; expiryTimer = null">
        {{ message.content }}
    </primevue-message>
</template>

<script>
import PrimevueMessage from 'primevue/message';

export default {
    emits: ['destroy'],

    components: {
        PrimevueMessage,
    },

    props: {
        index: {
            type: Number,
            required: true,
        },
        message: {
            type: Object,
            required: true,
        },
    },

    data: () => ({
        expiryTimer: null,
        fadeOut: false,
        ready: false,
    }),

    computed: {
        multipleContent() {
            return typeof this.message.content == 'object';
        }
    },

    beforeUnmount() {
        this.expiryTimer = null;
    },

    created() {
        this.ready = true;
    },

    mounted() {
        this.expiryTimer = setTimeout(() => this.timerExpired(), this.message.expiry);
    },

    methods: {
        timerExpired() {
            this.fadeOut = true;
            this.expiryTimer = setTimeout(() => this.$emit('destroy'), this.message.expiry);
        },
    },
};
</script>
