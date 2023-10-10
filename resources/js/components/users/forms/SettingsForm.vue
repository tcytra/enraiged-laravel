<template>
    <vue-form updating ref="settingsForm"
        :template="template"
        :updating="updating"
        @form:reset="$refs.themeFormSection.reset()">
        <template v-slot:ui_theme_section="props">
            <theme-form-section id="theme" v-bind="props" ref="themeFormSection"/>
        </template>
    </vue-form>
</template>

<script>
import ThemeFormSection from '@/components/ui/themes/ThemeFormSection.vue';
import VueForm from '@/components/forms/VueForm.vue';

export default {
    components: {
        ThemeFormSection,
        VueForm,
    },

    inject: ['i18n'],

    props: {
        template: {
            type: Object,
            required: true,
        },
    },
};
</script>
