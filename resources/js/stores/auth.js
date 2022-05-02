import { defineStore } from 'pinia';

export const Auth = defineStore('auth', {
    state: () => {
        return {
            user: null,
        }
    },

    /* getters: {
        results(state) {
            return state.user;
        },
    }, */

    actions: {
        setUser(user) {
            this.user = user;
        },
        unsetUser() {
            this.user = null;
        },
    },
});
