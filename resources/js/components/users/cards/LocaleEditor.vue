<template>
    <primevue-card class="mb-3 shadow-1">
        <template #header>
            <header class="header text-center text-lg">
                <span class="text">
                    {{ i18n('Update Language') }}
                </span>
            </header>
        </template>
        <template #content>
            <div class="flex col-8 auto-margin">
                <primevue-dropdown class="w-full" id="userLocale" optionLabel="name" optionValue="id"
                    v-model="form"
                    :options="languages">
                    <template #option="props">
                        <span :class="props.option.class">{{ props.option.name }}</span>
                    </template>
                </primevue-dropdown>
                <!--<primevue-button class="p-button-danger ml-1" icon="pi pi-times" style="min-width:36px; width:36px;"
                    v-tooltip.top="i18n('Reset')"
                    :disabled="!isDirty"
                    @click="reset"/>-->
                <primevue-button class="p-button-success ml-1" icon="pi pi-check" style="min-width:36px; width:36px;"
                    v-tooltip.top="i18n('Save')"
                    :disabled="!isDirty"
                    @click="save"/>
            </div>
        </template>
    </primevue-card>
</template>

<script>
import { createApp } from 'vue';
import { i18nVue } from 'laravel-vue-i18n';
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
        'initState',
        //'setLanguage',
    ],

    props: {
        resource: {
            type: Object,
            required: true,
        },
        languages: {
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
        language: null,
    }),

    computed: {
        isDirty() {
            return this.form !== this.language;
        },
    },

    created() {
        this.language = this.form = this.user.language;
    },

    methods: {
        reset() {
            this.form = this.user.language;
        },
        save() {
            const data = { language: this.form };
            const method = this.resource.method || 'get';
            const url = `${this.resource.uri}/language`;
            axios({ method, url, data })
                .then(({ data }) => {
                    if (data.success) {
                        this.$emit('success');
                        this.user.language = this.language = this.form;
                        if (this.user.is_myself) {
                            this.initState();
                        }
                        this.flashSuccess(data.success);
                    }
                })
                .catch(error => this.errorHandler(error));
        },
    },
};
</script>
