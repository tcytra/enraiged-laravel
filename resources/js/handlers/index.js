import { action } from '@/handlers/actions';
import { error } from '@/handlers/errors';
import { useLocales } from '@/handlers/locales';

const { ai18n, i18n, lang } = useLocales();

export function useHandlers() {
    return {
        action,
        ai18n,
        error,
        i18n,
        lang,
    };
};
