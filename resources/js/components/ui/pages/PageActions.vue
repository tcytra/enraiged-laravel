<template>
    <div class="actions">
        <div class="action" v-for="(button, index) in buttons"
            :class="{'current': button.current}"
            :key="index">
            <primevue-button class="button" v-if="canShow(button)"
                :class="button.class"
                :icon="button.icon"
                :label="i18n(button.label)"
                @click="actionHandler(button)"/>
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

    inject: ['errorHandler', 'flashSuccess', 'i18n', 'initState', 'meta'],

    props: {
        actions: {
            type: Object,
            default: [],
        },
        backButton: {
            type: Boolean,
            default: false,
        },
    },

    computed: {
        buttons() {
            return this.actions
                .map((action) => {
                    return {...action, current: this.isCurrent(action)};
                });
        },
        current() {
            const current = this.buttons
                .filter((action) => {
                    return action.current === true;
                });
            return current.length
                ? current[0]
                : null;
        },
        history() {
            return window.history.length > 0;
        },
    },

    methods: {
        back() {
            window.history.go(-1);
        },

        actionHandler(button, confirmed) {
            if (typeof button.uri === 'object') {
                const method = typeof button.uri.method !== 'undefined'
                    ? button.uri.method
                    : 'get';

                if (button.confirm && confirmed !== true) {
                    this.$confirm.require({
                        message: typeof button.confirm === 'string'
                            ? this.i18n(button.confirm)
                            : this.i18n('Are you sure you want to proceed?'),
                        header: this.i18n('Please confirm'),
                        icon: 'pi pi-exclamation-triangle',
                        acceptClass: 'p-button-danger',
                        acceptLabel: this.i18n('Yes'),
                        rejectLabel: this.i18n('No'),
                        accept: () => this.actionHandler(button, true),
                    });

                } else if (typeof button.uri.api !== 'undefined' && button.uri.api === true) {
                    this.axios[method](button.uri.route)
                        .then(({ data, status }) => {
                            if (data.success) {
                                this.flashSuccess(data.success);
                            }
                            if (status === 205) {
                                this.initState();
                            }
                            if (button.redirectDefault) {
                                this.actionHandler(this.actions.filter((each) => each.default === true)[0]);
                            }
                        })
                        .catch(error => this.errorHandler(error));

                } else {
                    this.$inertia[method](button.uri);
                }

            } else {
                this.$inertia.get(button.uri);
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

        redirectPage() {
            if (1) {
                
            }
            this.$inertia.get(this.$page.url);
        },
    },
};
</script>
