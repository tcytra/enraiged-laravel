<template>
    <div class="col-span-full line-break">
        <hr :class="field.break" v-if="typeof field.break === 'string'">
        <!--<hr v-else>-->
    </div>
</template>

<script setup>
defineProps({
    field: {
        type: Object,
        required: true,
    },
});
</script>
