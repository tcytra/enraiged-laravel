// import { useToast } from 'primevue/usetoast';
// const toast = useToast();

const flash = (detail, severity) => {
    // toast(message);
    // toast.add({ detail, severity, life: 3000 });
};

const flashDanger = (detail) => {
    flash(detail, 'danger');
};

const flashInfo = (detail) => {
    flash(detail, 'info');
};

const flashSuccess = (detail) => {
    flash(detail, 'success');
};

const flashWarning = (detail) => {
    flash(detail, 'warn');
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
