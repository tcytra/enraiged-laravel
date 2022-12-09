<template>
    <button :disabled="loading" class="flex items-center">
        <div class="btn-spinner mr-2" v-if="loading" />
        <slot />
    </button>
</template>

<script>
export default {
    props: {
        loading: Boolean,
    },
};
</script>
