<template>
    <div class="actions">
        <div class="action" v-for="(action, index) in actions"
            :class="{'current': current(action)}"
            :key="index">
            <primevue-button v-if="typeof action === 'object'"
                :class="action.class"
                :icon="action.icon"
                :label="i18n(action.label)"
                @click="handle(action)" />
        </div>
        <div class="action go-back" v-if="backButton && history" @click="back()">
            <primevue-button class="p-button-text text-neutral"
                icon="pi pi-angle-double-left"
                :label="i18n('Back')"/>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';
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

const back = () => {
    window.history.back();
};

const { i18n } = useLocales();

const { flashSuccess } = useMessages();

const confirm = useConfirm();

const current = (action) => {
    return route().current(action.route.name, action.route.params);
};

const handle = (action, confirmed) => {
    const requireConfirm = typeof action.confirm === 'string';
    const method = action.route.method || 'get';
    const name = action.route.name;
    const url = action.route.url || route(name);
    if (requireConfirm && confirmed !== true) {
        confirm.require({
            message: requireConfirm
                ? i18n(action.confirm)
                : i18n('Are you sure you want to proceed?'),
            header: i18n('Please confirm'),
            icon: 'pi pi-exclamation-triangle',
            acceptClass: 'p-button-danger',
            rejectClass: 'p-button-secondary',
            acceptLabel: i18n('Yes'),
            rejectLabel: i18n('No'),
            accept: () => handle(action, true),
        });
    } else {
        if (action.route.api) {
            axios[method](url)
                .then((response) => {
                    const { data } = response;
                    if (data.success) {
                        flashSuccess(data.success);
                    }
                    if (data.redirect) {
                        router.get(data.redirect);
                    }
                })
                .catch((e) => {
                    console.log(e);
                });
        } else {
            router[method](url);
        }
    }
};

const history = computed(() => window && window.history.length > 0);
</script>
