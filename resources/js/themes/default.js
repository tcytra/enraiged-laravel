import { definePreset } from '@primeuix/themes';
import Aura from '@primeuix/themes/aura';

// import { layout } from './default/layout';
// const {
//     primaryColors,
//     surfaces,
//     preset,
//     primary,
//     surface,
//     isDarkMode,
//     updateColors,
// } = layout();

const darkModeSelector = '.toggle-dark-mode';
const primaryColor = import.meta.env.VITE_PRIMARY_COLOR || 'emerald';
const surfaceColor = import.meta.env.VITE_SURFACE_COLOR || 'neutral';

const defaultPreset = definePreset(Aura, {
    semantic: {
        primary: {
            50: `{${primaryColor}.50}`,
            100: `{${primaryColor}.100}`,
            200: `{${primaryColor}.200}`,
            300: `{${primaryColor}.300}`,
            400: `{${primaryColor}.400}`,
            500: `{${primaryColor}.500}`,
            600: `{${primaryColor}.600}`,
            700: `{${primaryColor}.700}`,
            800: `{${primaryColor}.800}`,
            900: `{${primaryColor}.900}`,
            950: `{${primaryColor}.950}`,
        },
        colorScheme: {
            dark: {
                surface: {
                    50: `{${surfaceColor}.50}`,
                    100: `{${surfaceColor}.100}`,
                    200: `{${surfaceColor}.200}`,
                    300: `{${surfaceColor}.300}`,
                    400: `{${surfaceColor}.400}`,
                    500: `{${surfaceColor}.500}`,
                    600: `{${surfaceColor}.600}`,
                    700: `{${surfaceColor}.700}`,
                    800: `{${surfaceColor}.800}`,
                    900: `{${surfaceColor}.900}`,
                    950: `{${surfaceColor}.950}`,
                },
            },
            light: {
                surface: {
                    50: `{${surfaceColor}.50}`,
                    100: `{${surfaceColor}.100}`,
                    200: `{${surfaceColor}.200}`,
                    300: `{${surfaceColor}.300}`,
                    400: `{${surfaceColor}.400}`,
                    500: `{${surfaceColor}.500}`,
                    600: `{${surfaceColor}.600}`,
                    700: `{${surfaceColor}.700}`,
                    800: `{${surfaceColor}.800}`,
                    900: `{${surfaceColor}.900}`,
                    950: `{${surfaceColor}.950}`,
                },
            },
        },
        formField: {
            //paddingX: '0.75rem',
            //paddingY: '0.25rem',
        },
    },
    components: {
        button: {
        },
    },
});

const defaultTheme = {
    preset: defaultPreset,
    options: {
        cssLayer: {
            name: 'primevue',
            order: 'theme, base, primevue',
        },
        darkModeSelector,
    },
};

export default defaultTheme;
