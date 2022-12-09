<template>
    <div class="active-status">
        <span class="status-success" v-if="active"
            :class="{ 'is-rounded': rounded }">
            <i class="pi pi-check" v-if="icons"></i>
            <span class="text" v-else>
                {{ i18n(textActive) }}
            </span>
        </span>
        <span class="status-danger" v-else
            :class="{ 'is-rounded': rounded }">
            <i class="pi pi-times" v-if="icons"></i>
            <span class="text" v-else>
                {{ i18n(textInactive) }}
            </span>
        </span>
    </div>
</template>

<script>
// intended for boolean status
export default {
    inject: ['i18n'],

    props: {
        active: {
            type: Boolean,
            required: true,
        },
        icons: {
            type: Boolean,
            default: false,
        },
        rounded: {
            type: Boolean,
            default: false,
        },
        textActive: {
            type: String,
            default: 'Active',
        },
        textInactive: {
            type: String,
            default: 'Inactive',
        },
    },
};    
</script>
