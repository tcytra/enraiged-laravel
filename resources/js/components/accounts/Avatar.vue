<template>
    <div class="avatar">
        <span class="initials">
            {{ initials }}
        </span>
    </div>
</template>

<script>
export default {
    props: {
        initials: String,
    },
};
</script>
