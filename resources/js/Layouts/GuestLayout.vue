<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import { loadLanguageAsync as ai18n, getActiveLanguage as lang } from 'laravel-vue-i18n';
</script>

<template>
    <div class="fixed h-0">
        <div class="mx-5 my-1">
            <span class="p-1 cursor-pointer" :class="{'bg-[#cdcdcd]': lang() === 'en'}" @click="ai18n('en')">
                EN
            </span>
            <span class="p-1 cursor-pointer" :class="{'bg-[#cdcdcd]': lang() === 'es'}" @click="ai18n('es')">
                ES
            </span>
            <span class="p-1 cursor-pointer" :class="{'bg-[#cdcdcd]': lang() === 'fr'}" @click="ai18n('fr')">
                FR
            </span>
        </div>
    </div>
    <div class="flex min-h-screen flex-col items-center bg-gray-100 pt-6 sm:justify-center sm:pt-0">
        <div>
            <Link href="/">
                <ApplicationLogo class="h-20 w-20 fill-current text-gray-500" />
            </Link>
        </div>

        <div class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg">
            <slot />
        </div>
    </div>
</template>
