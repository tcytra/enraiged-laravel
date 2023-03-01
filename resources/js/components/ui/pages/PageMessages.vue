<template>
    <div class="help-messages" :class="class" v-if="messages.length">
        <primevue-message class="m-0 mb-3" v-for="(message, index) in messages"
            :closable="closable(message)"
            :severity="severity(message)"
            :key="index"
            @close="$emit('dismiss', index)">
            {{ message.body }}
        </primevue-message>
    </div>
</template>

<script>
import PrimevueMessage from 'primevue/message/Message.vue';

export default {
    components: {
        PrimevueMessage,
    },

    props: {
        class: {
            type: String,
            default: null,
        },
        messages: {
            type: Array,
            default: [],
        },
    },

    methods: {
        closable(message) {
            return typeof message.closable !== 'undefined'
                ? message.closable
                : true;
        },
        severity(message) {
            return typeof message.severity !== 'undefined'
                ? message.severity
                : 'info';
        },
    },
};
</script>
