<template>
    <a :href="link">{{ address }}</a>
</template>

<script>
export default {
    props: {
        address: {
            type: String,
            required: true,
        },
    },

    computed: {
        link() {
            return `mailto:${this.address}`;
        },
    }
};
</script>
