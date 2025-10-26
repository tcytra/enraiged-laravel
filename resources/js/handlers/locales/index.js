import { trans, getActiveLanguage, loadLanguageAsync } from 'laravel-vue-i18n';

export function useLocales() {
    return {
        ai18n: loadLanguageAsync,
        i18n: trans,
        lang: getActiveLanguage,
    };
};
