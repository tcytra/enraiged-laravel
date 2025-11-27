<template>
    <form class="form grid grid-cols-1 mt-1" @submit.prevent="submit">
        <hidden-field :field="{ id: 'locale' }" :form="form" />
        <div class="flex flex-col lg:flex-row lg:justify-between mt-3 w-full">
            <primary-button class="!px-6 mb-5 lg:mb-0" v-for="(name, locale) in locales"
                :disabled="form.processing || form.locale === locale"
                :key="locale"
                @click="set(locale)">
                {{ name }}
            </primary-button>
        </div>
    </form>
</template>

<script setup>
import { inject } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { useLocales } from '@/handlers/locales';
import HiddenField from '@/components/forms/fields/HiddenField.vue';
import PrimaryButton from '@/components/ui/buttons/SecondaryButton.vue';

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

const locales = meta.value.locales;

const user = props.user;

const form = useForm({
    locale: props.user.locale,
});

const set = (locale) => {
    if (props.isMyProfile) {
        ai18n(locale);
    }
    form.locale = locale;
    submit();
};

const submit = () => {
    form.patch(route('users.update', {user: user.id}));
};
</script>
