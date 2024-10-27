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
            <div class="flex col-8 auto-margin">
                <primevue-dropdown class="w-full" id="userTheme" optionLabel="name" optionValue="id"
                    v-model="form"
                    :options="themes"
                    @update:modelValue="preview">
                    <template #option="props">
                        <span :class="props.option.class">{{ props.option.name }}</span>
                    </template>
                </primevue-dropdown>
                <primevue-button class="p-button-danger ml-1" icon="pi pi-times" style="min-width:36px; width:36px;"
                    v-tooltip.top="i18n('Reset')"
                    :disabled="!isDirty"
                    @click="reset"/>
                <primevue-button class="p-button-success ml-1" icon="pi pi-check" style="min-width:36px; width:36px;"
                    v-tooltip.top="i18n('Save')"
                    :disabled="!isDirty"
                    @click="save"/>
            </div>
        </template>
    </primevue-card>
</template>

<script>
import PrimevueButton from 'primevue/button';
import PrimevueCard from 'primevue/card';
import PrimevueDropdown from 'primevue/dropdown';
import PrimevueTooltip from 'primevue/tooltip';

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
        'setTheme',
    ],

    props: {
        resource: {
            type: Object,
            required: true,
        },
        themes: {
            type: Array,
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
        preview() {
            if (this.user.is_myself) {
                this.$primevue.changeTheme(this.theme, this.form, 'theme-color', () => {});
            }
        },
        reset() {
            if (this.user.is_myself) {
                this.$primevue.changeTheme(this.form, this.theme, 'theme-color', () => {});
            }
            this.form = this.theme;
        },
        save() {
            const data = { theme: this.form };
            const method = this.resource.method || 'get';
            const url = `${this.resource.uri}/theme`;
            axios({ method, url, data })
                .then(({ data }) => {
                    this.theme = this.form;
                    if (data.success) {
                        this.flashSuccess(data.success);
                    }
                })
                .catch(error => this.errorHandler(error));
        },
    },
};
</script>
