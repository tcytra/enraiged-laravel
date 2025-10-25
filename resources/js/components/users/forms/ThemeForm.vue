<template>
    <form class="form" @submit.prevent="submit">

        <!--
        <div class="flex flex-col gap-4 w-[16rem]">
            <span class="text-sm text-surface font-semibold">
                {{ i18n('Primary Color') }} | {{ currentPrimary }}
            </span>
            <div class="flex flex-wrap justify-start gap-2">
                <button class="border-none w-5 h-5 rounded-full p-0 cursor-pointer focus:outline-none" type="button"
                    v-for="(range, name) in primaryColors"
                    :key="name"
                    :style="primaryButtonStyle(name, range)"
                    :title="name"
                    @click="togglePrimary(name)" />
            </div>
            <span class="text-sm text-surface font-semibold">
                {{ i18n('Surface Color') }} | {{ currentSurface }}
            </span>
            <div class="flex flex-wrap justify-start gap-2">
                <button class="border-none w-5 h-5 rounded-full p-0 cursor-pointer focus:outline-none" type="button"
                    v-for="(range, name) in surfaceColors"
                    :key="name"
                    :style="surfaceButtonStyle(name, range)"
                    :title="name"
                    @click="toggleSurface(name)" />
            </div>
        </div>
        -->

    </form>
</template>

<script setup>
import { computed, inject } from 'vue';
import { palette } from '@/themes/palette';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    alert: {
        type: String,
    },
    errors: {
        type: Object,
    },
    isMyProfile: {
        type: Boolean,
    },
    user: {
        type: Object,
    },
});

const {
    currentPrimary, currentSurface, enableDarkMode, primaryColors, surfaceColors, updatePrimary, updateSurface,
} = palette();

const { i18n } = inject('intl');

const user = props.user;

const form = useForm({
    theme: user.theme,
});

const submit = () => {
    form.patch(route('users.update', {user: user.id}));
};
</script>
