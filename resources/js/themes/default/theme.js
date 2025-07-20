import { definePreset } from '@primeuix/themes';
import { palette } from '@/themes/palette';
import Aura from '@primevue/themes/aura'; // options: Aura, Lara, Material, Nora

const { currentPrimary, currentSurface, darkModeSelector, primaryColors, surfaceColors } = palette();

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

const theme = {
    preset: defaultPreset,
    options: {
        cssLayer: {
            name: 'primevue',
            order: 'theme, base, primevue, utilities',
        },
        darkModeSelector,
    },
};

export default theme;
