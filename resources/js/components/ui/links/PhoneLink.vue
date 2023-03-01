<template>
    <a :href="link">{{ number }}</a>
</template>

<script>
export default {
    props: {
        number: {
            type: String,
            required: true,
        },
    },

    computed: {
        link() {
            return `tel:${this.number}`;
        },
    }
};
</script>
