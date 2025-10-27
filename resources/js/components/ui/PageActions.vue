<template>
    <div class="actions">
        <div class="action" v-for="(action, index) in actions"
            :class="{'current': current(action)}"
            :key="index">
            <primevue-button v-if="typeof action === 'object'"
                :class="action.class"
                :icon="action.icon"
                :label="i18n(action.label)"
                @click="handle(route, action)" />
        </div>
        <div class="action go-back" v-if="backButton && history" @click="back()">
            <primevue-button class="p-button-text text-neutral"
                icon="pi pi-angle-double-left"
                :label="i18n('Back')"/>
        </div>
    </div>
</template>

<script setup>
import { computed, inject } from 'vue';
import { router } from '@inertiajs/vue3';
import { useConfirm } from 'primevue/useconfirm';
import { useLocales } from '@/handlers/locales';
import { useMessages } from '@/handlers/messages';
import PrimevueButton from 'primevue/button';

const props = defineProps({
    actions: {
        type: Object,
    },
    backButton: {
        type: Boolean,
        default: false,
    },
});

const route = inject('route');

const back = () => {
    window.history.back();
};

const { i18n } = useLocales();

const confirm = useConfirm();

const current = (action) => {
    return route().current(action.route.name, action.route.params);
};

const handle = (action, confirmed) => {
    const { route } = action;
    if (action.confirm && confirmed !== true) {
        //  todo: why is this not working? on the edit page it opens the og dialog, on the show page it does nothing
        confirm.require({
            message: typeof action.confirm === 'string'
                ? i18n(action.confirm)
                : i18n('Are you sure you want to proceed?'),
            header: i18n('Please confirm'),
            icon: 'pi pi-exclamation-triangle',
            acceptClass: 'p-button-danger',
            rejectClass: 'p-button-secondary',
            acceptLabel: i18n('Yes'),
            rejectLabel: i18n('No'),
            accept: () => handle(route, action, true),
        });
    } else {
        router[route.method](route.url);
    }
};

const history = computed(() => window && window.history.length > 0);
</script>
