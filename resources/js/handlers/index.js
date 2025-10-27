import { action } from '@/handlers/actions';
import { error } from '@/handlers/errors';
import { useLocales } from '@/handlers/locales';
import { useMessages } from '@/handlers/messages';

const { ai18n, i18n, lang } = useLocales();

const { flash, flashDanger, flashInfo, flashSuccess, flashWarning } = useMessages();

export function useHandlers() {
    return {
        action,
        ai18n,
        error,
        flash,
        flashDanger,
        flashInfo,
        flashSuccess,
        flashWarning,
        i18n,
        lang,
    };
};
