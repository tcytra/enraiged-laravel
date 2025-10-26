<template>
    <!--
    <div class="navigation options static">
        <div class="item">
            <a class="option" @click="router.get(route('my.profile.edit'))">
                <i class="icon pi pi-user"></i>
                <span class="text">My Profile</span>
            </a>
        </div>
    </div>
    -->
    <primevue-panel-menu class="navigation options" unstyled
        :class="{ 'static': menu.static }"
        :expanded-keys="keys"
        :model="items">
        <template #item="{ item, props }">
            <div class="item" v-if="item.route"
                :class="{
                    'child': item.key.match(/\d+_\d+/),
                    'current': active(item),
                }"
                @click="handle(item, menu, mobile && menu.open)">
                <a class="option" v-bind="props.options">
                    <i class="icon" :class="item.icon"></i>
                    <span class="text">{{ i18n(item.label) }}</span>
                </a>
            </div>
            <div class="heading item" v-else>
                <div class="option">
                    <h5 class="text">{{ i18n(item.label) }}</h5>
                    <i class="icon pi pi-chevron-down" v-if="menu.static"></i>
                    <i class="icon pi pi-chevron-left" :class="item.class" v-else></i>
                </div>
            </div>
        </template>
    </primevue-panel-menu>
</template>

<script setup>
import { computed, ref } from 'vue';
import { useLocales } from '@/handlers/locales';
import { useMenus } from '@/handlers/menus';
import PrimevuePanelMenu from 'primevue/panelmenu';

const props = defineProps({
    menu: {
        type: Object,
        required: true,
    },
    mobile: {
        type: Boolean,
        default: false,
    },
});

const { active, expand, handle, make } = useMenus();

const { i18n } = useLocales();

const items = computed(() => make(props.menu));

const keys = expand(items);
</script>
