import { computed, ref } from 'vue';
import { primaryColors } from './colors/primary';
import { surfaceColors } from './colors/surface';
import { updatePrimaryPalette, updateSurfacePalette } from '@primeuix/themes';

const darkModeSelector = '.dark-mode';

const enableDarkMode = () => {
    if (typeof window === 'undefined') {
        return false;
    }

    return localStorage.hasOwnProperty('theme.enableDarkMode')
        ? JSON.parse(localStorage.getItem('theme.enableDarkMode'))
        : window.matchMedia('(prefers-color-scheme: dark)').matches;
};

const darkModeEnabled = ref(enableDarkMode());

const toggleDarkMode = (toggle) => {
    if (typeof toggle === 'undefined') {
        toggle = enableDarkMode();
    } else {
        localStorage.setItem('theme.enableDarkMode', toggle);
    }

    document.documentElement.classList.toggle('dark-mode', toggle);
};

const getPrimaryColor = () => {
    const defaultPrimaryColor = import.meta.env.VITE_PRIMARY_COLOR || 'noir';

    if (typeof window === 'undefined') {
        return defaultPrimaryColor;
    }

    return localStorage.hasOwnProperty('theme.primaryColor')
        ? localStorage.getItem('theme.primaryColor')
        : defaultPrimaryColor;
};

const getSurfaceColor = () => {
    const defaultSurfaceColor = import.meta.env.VITE_SURFACE_COLOR || 'neutral';

    if (typeof window === 'undefined') {
        return defaultSurfaceColor;
    }

    return localStorage.hasOwnProperty('theme.surfaceColor')
        ? localStorage.getItem('theme.surfaceColor')
        : defaultSurfaceColor;
};

const currentPrimaryColor = ref(getPrimaryColor());
const currentSurfaceColor = ref(getSurfaceColor());

const updatePrimaryColor = (primary) => {
    localStorage.setItem('theme.primaryColor', primary);
    updatePrimaryPalette(primaryColors[primary]);
    currentPrimaryColor.value = primary;
};

const updateSurfaceColor = (surface) => {
    localStorage.setItem('theme.surfaceColor', surface);
    updateSurfacePalette(surfaceColors[surface]);
    currentSurfaceColor.value = surface;
};

export function palette() {
    return {
        currentPrimaryColor,
        currentSurfaceColor,
        darkModeEnabled,
        darkModeSelector,
        primaryColors,
        surfaceColors,
        toggleDarkMode,
        updatePrimaryColor,
        updateSurfaceColor,
    };
};
