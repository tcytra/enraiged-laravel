<template>
    <div class="">
        <label for="openPalette" class="cursor-pointer item label">
            <i class="pi pi-palette" @click="openPalette"></i>
        </label>
        <primevue-popover ref="selectPalette">
            <div class="flex flex-col gap-4 w-[16rem]">
                <span class="text-sm text-surface font-semibold">
                    {{ i18n('Primary Color') }} | {{ currentPrimaryColor }}
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
                    {{ i18n('Surface Color') }} | {{ currentSurfaceColor }}
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
        </primevue-popover>
    </div>
</template>

<script setup>
import { computed, inject, ref, watch } from 'vue';
import { palette } from '@/themes/palette';
import { useLocales } from '@/handlers/locales';
import PrimevuePopover from 'primevue/popover';
import SelectButton from 'primevue/selectbutton';

const { theme } = inject('app');

const { i18n } = useLocales();

const {
    currentPrimaryColor,
    currentSurfaceColor,
    darkModeEnabled,
    primaryColors,
    surfaceColors,
    updatePrimaryColor,
    updateSurfaceColor,
} = palette();

const selectPalette = ref();

const primaryButtonStyle = (name, range) => {
    const currentBackground = darkModeEnabled.value ? range['800'] : range['700']
    const defaultBackground = darkModeEnabled.value ? range['500'] : range['400'];
    return name === currentPrimaryColor.value
        ? { backgroundColor: currentBackground }
        : { backgroundColor: defaultBackground };
};

const surfaceButtonStyle = (name, range) => {
    const currentBackground = darkModeEnabled.value ? range['800'] : range['300']
    const defaultBackground = darkModeEnabled.value ? range['500'] : range['600'];
    return name === currentSurfaceColor.value
        ? { backgroundColor: currentBackground }
        : { backgroundColor: defaultBackground };
};

const openPalette = (event) => {
    selectPalette.value.toggle(event);
};

const togglePrimary = (value) => {
    theme({ primary: value });
    updatePrimaryColor(value);
};

const toggleSurface = (value) => {
    theme({ surface: value });
    updateSurfaceColor(value);
};
</script>
