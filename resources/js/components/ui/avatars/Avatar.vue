<template>
    <div class="avatar inline-block relative"
        :class="{ 'editable': editable }">
        <primevue-button class="absolute p-button-icon-only p-button-rounded p-button-xs p-button-success"
            icon="pi pi-pencil"
            style="top:0;right:0;"
            v-if="editable"
            v-tooltip.top="i18n('Update this avatar')"
            @click="clicked"/>
        <primevue-avatar shape="circle" v-if="avatar.file"
            :class="backgroundClass"
            :image="avatar.file.uri"
            @click="clicked"/>
        <primevue-avatar shape="circle" v-else
            :class="backgroundClass"
            :label="avatar.chars"
            :style="backgroundColor"
            @click="clicked"/>
        <!--<active icons rounded v-if="[false,true].includes(active)"
            :active="active"/>-->
    </div>
</template>

<script>
// import Active from '@/components/ui/indicators/Active.vue';
import PrimevueAvatar from 'primevue/avatar/Avatar.vue';
import PrimevueButton from 'primevue/button/Button.vue';
import PrimevueTooltip from 'primevue/tooltip/tooltip.esm.js';

export default {
    components: {
        // Active,
        PrimevueAvatar,
        PrimevueButton,
    },

    directives: {
        tooltip: PrimevueTooltip,
    },

    inject: ['actionHandler', 'i18n'],

    props: {
        action: {
            type: [Object, String],
            default: null,
        },
        active: {
            type: Boolean,
            default: null,
        },
        avatar: {
            type: Object,
            required: true,
        },
        border: {
            type: Boolean,
            default: false,
        },
        editable: {
            type: Boolean,
            default: false,
        },
        greyscale: {
            type: Boolean,
            default: false,
        },
        greyscaleDark: {
            type: Boolean,
            default: false,
        },
        greyscaleLight: {
            type: Boolean,
            default: false,
        },
        hover: {
            type: Boolean,
            default: false,
        },
        size: {
            type: String,
            default: '',
        },
    },

    computed: {
        backgroundClass() {
            return {
                'cursor-pointer': this.action || this.hover,
                'greyscale-dark': this.greyscale || this.greyscaleDark,
                'greyscale-light': this.greyscaleLight,
                'has-border': this.border,
                'p-avatar-sm': this.size === 'sm',
                'p-avatar-md': this.size === 'md',
                'p-avatar-lg': this.size === 'lg',
                'p-avatar-xl': this.size === 'xl',
                'p-avatar-xx': this.size === 'xx',
            };
        },
        backgroundColor() {
            return `background-color:${this.avatar.color};`;
        },
    },

    methods: {
        clicked() {
            const event = 'avatar:clicked';
            if (this.action) {
                this.actionHandler(this.action, event);
            } else {
                this.$emit(event);
            }
        },
    }
};    
</script>
