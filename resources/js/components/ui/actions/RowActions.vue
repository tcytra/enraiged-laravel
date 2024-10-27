<template>
    <div class="actions flex">
        <span class="action" v-for="(action, index) in actions" :key="index">
            <primevue-button class="p-button-rounded p-button-sm p-button-text"
                :class="action.class"
                :disabled="action.disabled || disabled"
                :icon="action.icon"
                :key="index"
                v-if="!action.type || action.type === 'row'"
                v-tooltip.top="i18n(action.tooltip || index)"
                @click="actionHandler(action, index)"/>
        </span>
    </div>
</template>

<script>
import PrimevueButton from 'primevue/button';
import PrimevueTooltip from 'primevue/tooltip';

export default {
    components: {
        PrimevueButton,
    },

    directives: {
        tooltip: PrimevueTooltip,
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
            required: true,
        },
        disabled: {
            type: Boolean,
            default: false,
        },
    },

    methods: {
        actionHandler(action, index, confirmed) {
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
                    accept: () => this.actionHandler(action, index, true),
                });
            } else if (action.emit || action.method === 'emit') {
                this.$emit(index, action);
            } else if (typeof action.uri === 'object') {
                const method = typeof action.uri.method !== 'undefined'
                    ? action.uri.method
                    : 'get';

                if (typeof action.method !== 'undefined' && action.method === 'emit') {
                    const emit = action.emit || `action:${index}`;
                    this.$emit(emit, action);

                } else if (typeof action.uri.api !== 'undefined' && action.uri.api === true) {
                    axios[method](action.uri.route)
                        .then(({ data, status }) => {
                            if (this.isSuccess(status)) {
                                if (action.emit) {
                                    this.$emit(index, action);
                                }
                                if (data.success) {
                                    this.$emit('success', action);
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
                                }
                            }
                        })
                        .catch((error) => this.errorHandler(error));
                }

            } else if (typeof action.uri === 'string') {
                this.$inertia.get(action.uri);
            }
        },
    },
};
</script>
