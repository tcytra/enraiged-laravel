<template>
    <form class="form grid grid-cols-1 mt-1" @submit.prevent="submit">
        <hidden-field id="locale"
            :field="{
            }"
            :form="form">
            <template #content="field">
                <div class="control field">
                    <label class="block label">
                        {{ field.label }}
                    </label>
                    <div class="flex flex-col lg:flex-row lg:justify-between w-full">
                        <secondary-button class="!px-6 mb-5 lg:mb-0" v-for="(name, locale) in locales"
                            :disabled="form.processing || form.locale === locale"
                            :key="locale"
                            @click="form.locale = locale; ai18n(locale); submit()">
                            {{ name }}
                        </secondary-button>
                    </div>
                </div>
            </template>
        </hidden-field>
    </form>
</template>

<script setup>
import { inject } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { useLocales } from '@/handlers/locales';
import HiddenField from '@/components/forms/fields/HiddenField.vue';
import SecondaryButton from '@/components/ui/buttons/SecondaryButton.vue';

const props = defineProps({
    alert: {
        type: String,
    },
    errors: {
        type: Object,
    },
    isMyProfile: {
        type: Boolean,
    },
    user: {
        type: Object,
    },
});

const { ai18n, i18n } = useLocales();
const { meta } = inject('app');
const route = inject('route');
const locales = meta.value.locales;
const user = props.user;

const form = useForm({
    locale: props.user.locale,
});

const submit = () => {
    form.patch(route('users.update', {user: user.id}));
};
</script>
