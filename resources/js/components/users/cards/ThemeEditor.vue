<template>
    <primevue-card class="mb-3 shadow-1">
        <template #header>
            <header class="header text-center text-lg">
                <span class="text">
                    {{ i18n('Update Theme') }}
                </span>
            </header>
        </template>
        <template #content>
            <div class="flex justify-content-center m-3">
                <primevue-dropdown class="width-160" id="userTheme" optionLabel="name" optionValue="id"
                    v-model="form"
                    :options="meta.themes">
                    <template #option="props">
                        <span :class="props.option.class">{{ props.option.name }}</span>
                    </template>
                </primevue-dropdown>
                <primevue-button class="p-button-danger ml-1" icon="pi pi-times"
                    v-tooltip.top="i18n('Revert!')"
                    :disabled="!isDirty"
                    @click="clear"/>
                <primevue-button class="p-button-success ml-1" icon="pi pi-check"
                    v-tooltip.top="i18n('Save it!')"
                    :disabled="!isDirty"
                    @click="save"/>
            </div>
        </template>
    </primevue-card>
</template>

<script>
import PrimevueButton from 'primevue/button/Button.vue';
import PrimevueCard from 'primevue/card/Card.vue';
import PrimevueDropdown from 'primevue/dropdown/Dropdown.vue';
import PrimevueTooltip from 'primevue/tooltip/tooltip.esm.js';

export default {
    components: {
        PrimevueButton,
        PrimevueCard,
        PrimevueDropdown,
    },

    directives: {
        tooltip: PrimevueTooltip,
    },

    inject: [
        'errorHandler',
        'flashSuccess',
        'i18n',
        'initState',
        'meta',
    ],

    props: {
        resource: {
            type: Object,
            required: true,
        },
        user: {
            type: Object,
            required: true,
        },
    },

    data: () => ({
        form: null,
        theme: null,
    }),

    computed: {
        isDirty() {
            return this.form !== this.theme;
        },
    },

    created() {
        this.theme = this.form = this.user.theme;
    },

    methods: {
        clear() {
            this.form = this.theme;
        },
        save() {
            const data = { theme: this.form };
            const method = this.resource.method || 'get';
            const url = `${this.resource.uri}/theme`;
            this.axios({ method, url, data })
                .then(({ data }) => {
                    this.theme = this.form;
                    if (data.success) {
                        this.flashSuccess(data.success);
                    }
                    if (this.user.is_myself) {
                        this.initState();
                    }
                })
                .catch(error => this.errorHandler(error));
        },
    },
};
</script>
