<template>
    <div class="actions">
        <div class="action" v-for="(action, index) in actions"
            :class="{'current': this.isCurrent(action)}"
            :key="index">
            <primevue-button class="button" v-if="canShow(action)"
                :class="action.class"
                :icon="action.icon"
                :label="i18n(action.label)"
                @click="actionHandler(action)"/>
        </div>
        <div class="action go-back" v-if="backButton && history" @click="back()">
            <primevue-button class="button p-button-info p-button-text"
                icon="pi pi-angle-double-left"
                :label="i18n('Back')"/>
        </div>
    </div>
</template>

<script>
import PrimevueButton from 'primevue/button/Button.vue';

export default {
    components: {
        PrimevueButton,
    },

    inject: [
        'back',
        'errorHandler',
        'flash',
        'flashSuccess',
        'i18n',
        'isSuccess',
        'initState',
        'meta',
    ],

    props: {
        actions: {
            type: Object,
        },
        backButton: {
            type: Boolean,
            default: false,
        },
    },

    computed: {
        current() {
            const actions = Object.keys(this.actions)
                .filter((action) => this.isCurrent(this.actions[action]));
            return actions.length
                ? this.actions[actions[0]]
                : null;
        },
        default() {
            const actions = Object.keys(this.actions)
                .filter((action) => this.actions[action].default);
            return actions.length
                ? this.actions[actions[0]]
                : null;
        },
        history() {
            return window.history.length > 0;
        },
    },

    methods: {
        actionHandler(action, confirmed) {
            if (typeof action.uri === 'object') {
                const method = typeof action.uri.method !== 'undefined'
                    ? action.uri.method
                    : 'get';

                if (action.confirm && confirmed !== true) {
                    this.$confirm.require({
                        message: typeof action.confirm === 'string'
                            ? this.i18n(action.confirm)
                            : this.i18n('Are you sure you want to proceed?'),
                        header: this.i18n('Please confirm'),
                        icon: 'pi pi-exclamation-triangle',
                        acceptClass: 'p-button-danger',
                        acceptLabel: this.i18n('Yes'),
                        rejectLabel: this.i18n('No'),
                        accept: () => this.actionHandler(action, true),
                    });

                } else if (typeof action.uri.api !== 'undefined' && action.uri.api === true) {
                    this.axios[method](action.uri.route)
                        .then(({ data, status }) => {
                            if (this.isSuccess(status)) {
                                if (action.emit) {
                                    this.$emit('action', action);
                                }
                                if (data.success) {
                                    this.flashSuccess(data.success);
                                } else
                                if (data.message) {
                                    this.flash(data.message);
                                }
                                if (status === 205) {
                                    this.initState();
                                }
                                if (data.redirect) {
                                    this.$inertia.get(data.redirect);
                                } else
                                if (action.uri.redirect) {
                                    if (action.uri.redirect === 'back') {
                                        this.back();
                                    }
                                    if (action.uri.redirect === 'default') {
                                        this.actionHandler(this.default);
                                    }
                                    //if (action.uri.redirect.match(/[a-z]+/)) {
                                    //    
                                    //}
                                }
                            }
                        })
                        .catch((error) => this.errorHandler(error));
                }

            } else {
                if (action.emit) {
                    this.$emit('action', action);
                }
                if (typeof action.uri === 'string') {
                    this.$inertia.get(action.uri);
                }
            }
        },

        canShow(action) {
            return action.class && action.icon;
        },

        isCurrent(action) {
            if (typeof action.uri !== 'undefined') {
                const route = typeof action.uri.route !== 'undefined'
                    ? action.uri.route
                    : action.uri;
                const url = `${this.meta.app_host}${this.$page.url}`;

                if (route === url) {
                    return true;
                }
            }

            return false;
        },
    },
};
</script>
