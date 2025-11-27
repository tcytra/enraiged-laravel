import ToastEventBus from 'primevue/toasteventbus';

const flash = (detail, severity, summary) => {
    ToastEventBus.emit('add', { detail, severity, summary, life: 3000 });
};

const flashDanger = (detail, summary) => {
    flash(detail, 'danger', summary || 'Danger');
};

const flashInfo = (detail, summary) => {
    flash(detail, 'info', summary || 'Information');
};

const flashSuccess = (detail, summary) => {
    flash(detail, 'success', summary || 'Success');
};

const flashWarning = (detail, summary) => {
    flash(detail, 'warn', summary || 'Warning');
};

export function useMessages() {
    return {
        flash,
        flashDanger,
        flashInfo,
        flashSuccess,
        flashWarning,
    };
};
