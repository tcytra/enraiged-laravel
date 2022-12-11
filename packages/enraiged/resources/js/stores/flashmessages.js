import { defineStore } from 'pinia';

export const FlashMessages = defineStore('flash-messages', {
    state: () => {
        return {
            messages: [],
        }
    },

    getters: {
        results(state) {
            return state.messages;
        },
    },

    actions: {
        flash(message) {
            if (typeof message === 'object') {
                this.messages.push(message);
            } else {
                this.flashSuccess(message);
            }
        },
        flashError(message) {
            this.messages.push({ severity: 'error', content: message, expiry: 3000 });
        },
        flashInfo(message) {
            this.messages.push({ severity: 'info', content: message, expiry: 3000 });
        },
        flashSuccess(message) {
            this.messages.push({ severity: 'success', content: message, expiry: 3000 });
        },
        flashWarning(message) {
            this.messages.push({ severity: 'warn', content: message, expiry: 3000 });
        },
        unflash(index) {
            this.messages.splice(index, 1);
        },
    }
});
