import { definePreset } from '@primeuix/themes';
import { palette } from '@/themes/palette';
import Aura from '@primeuix/themes/aura'; // options: Aura, Lara, Material, Nora

const {
    currentPrimary,
    currentSurface,
    darkModeSelector,
    primaryColors,
    surfaceColors,
} = palette();

const defaultPreset = definePreset(Aura, {
    semantic: {
        primary: primaryColors[currentPrimary.value],
        colorScheme: {
            dark: {
                surface: surfaceColors[currentSurface.value],
            },
            light: {
                surface: surfaceColors[currentSurface.value],
            },
        },
        formField: {
            //paddingX: '0.75rem',
            //paddingY: '0.25rem',
            //etc
        },
    },
    components: {
        button: {
        },
    },
});

export default {
    pt: {
        /*
        card: {
            header: {
                class: 'card-header-test',
            },
        },
        */
    },
    theme: {
        preset: defaultPreset,
        options: {
            cssLayer: {
                name: 'primevue',
                order: 'theme, base, primevue, utilities',
            },
            darkModeSelector,
        },
    },
    ripple: true,
};
