import { definePreset } from '@primeuix/themes';
import { palette } from '@/themes/palette';
import Aura from '@primeuix/themes/aura'; // options: Aura, Lara, Material, Nora

const {
    currentPrimaryColor,
    currentSurfaceColor,
    darkModeSelector,
    primaryColors,
    surfaceColors,
} = palette();

const defaultPreset = definePreset(Aura, {
    semantic: {
        primary: primaryColors[currentPrimaryColor.value],
        colorScheme: {
            dark: {
                surface: surfaceColors[currentSurfaceColor.value],
            },
            light: {
                surface: surfaceColors[currentSurfaceColor.value],
            },
        },
        /* example custom primevue semantic tokens
        formField: {
            paddingX: '0.75rem',
            paddingY: '0.25rem',
        },
        */
    },
    /* example custom primevue component tokens
    components: {
        button: {
        },
    },
    */
});

export default {
    pt: {
        /* example primevue component passthrough (pt)
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
