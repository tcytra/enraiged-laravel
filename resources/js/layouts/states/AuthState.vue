<template>
    <div id="layout" class="auth layout">
        <header class="border-b">
            <!-- Primary Navigation Menu -->
            <div class="mx-auto max-w-7xl">
                <div class="flex h-16 justify-between">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex shrink-0 items-center">
                            <Link :href="route('dashboard')">
                                <ApplicationLogo class="block h-9 w-auto fill-current" />
                            </Link>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <NavLink
                                :href="route('dashboard')"
                                :active="route().current('dashboard')">
                                {{ i18n('Dashboard') }}
                            </NavLink>
                        </div>
                    </div>

                    <div class="hidden sm:ms-6 sm:flex sm:items-center">
                        <!-- Toggle Dark Mode -->
                        <toggle-dark-mode class="mr-3" />

                        <!-- Toggle Dark Mode -->
                        <toggle-palette class="mr-3" />

                        <!-- Settings Dropdown -->
                        <div class="relative ms-3">
                            <secondary-button @click="toggle">
                                <span>{{ auth.name }}</span>
                                <svg class="-me-0.5 ms-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                </svg>
                            </secondary-button>
                            <primevue-popover ref="op">
                                <div class="flex flex-col gap-4 w-[12rem]">
                                    <dropdown-link :href="route('my.profile.edit')">
                                        {{ i18n('My Profile') }}
                                    </dropdown-link>
                                    <dropdown-link as="button" method="post" :href="route('logout')">
                                        {{ i18n('Logout') }}
                                    </dropdown-link>
                                </div>
                            </primevue-popover>
                            <!--
                            <Dropdown align="right" width="48">
                                <template #content>
                                    <DropdownLink
                                        :href="route('my.profile.edit')">
                                        {{ i18n('Profile') }}
                                    </DropdownLink>
                                    <DropdownLink
                                        :href="route('logout')"
                                        method="post"
                                        as="button">
                                        {{ i18n('Logout') }}
                                    </DropdownLink>
                                </template>
                            </Dropdown>
                            -->
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="-me-2 flex items-center sm:hidden">
                        <button
                            @click="
                                showingNavigationDropdown =
                                    !showingNavigationDropdown
                            "
                            class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none">
                            <svg
                                class="h-6 w-6"
                                stroke="currentColor"
                                fill="none"
                                viewBox="0 0 24 24">
                                <path
                                    :class="{
                                        hidden: showingNavigationDropdown,
                                        'inline-flex':
                                            !showingNavigationDropdown,
                                    }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                                <path
                                    :class="{
                                        hidden: !showingNavigationDropdown,
                                        'inline-flex':
                                            showingNavigationDropdown,
                                    }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{
                    block: showingNavigationDropdown,
                    hidden: !showingNavigationDropdown,
                }"
                class="sm:hidden">
                <div class="space-y-1 pb-3 pt-2">
                    <ResponsiveNavLink
                        :href="route('dashboard')"
                        :active="route().current('dashboard')">
                        {{ i18n('Dashboard') }}
                    </ResponsiveNavLink>
                </div>

                <!-- Responsive Settings Options -->
                <div class="border-t border-gray-200 pb-1 pt-4">
                    <div class="px-4">
                        <div class="text-base font-medium text-gray-800">
                            {{ auth.name }}
                        </div>
                        <div class="text-sm font-medium text-gray-500">
                            {{ auth.email }}
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <ResponsiveNavLink :href="route('my.profile.edit')">
                            {{ i18n('Profile') }}
                        </ResponsiveNavLink>
                        <ResponsiveNavLink
                            :href="route('logout')"
                            method="post"
                            as="button">
                            {{ i18n('Log Out') }}
                        </ResponsiveNavLink>
                    </div>
                </div>
            </div>
        </header>

        <main class="main">
            <slot />
        </main>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { inject, ref } from 'vue';
import ApplicationLogo from '@/components/ui/ApplicationLogo.vue';
import DropdownLink from '@/components/ui/links/DropdownLink.vue';
import NavLink from '@/components/ui/links/NavLink.vue';
import PrimevuePopover from 'primevue/popover';
import ResponsiveNavLink from '@/components/ui/links/ResponsiveNavLink.vue';
import SecondaryButton from '@/components/ui/buttons/SecondaryButton.vue';
import ToggleDarkMode from '@/components/ui/ToggleDarkMode.vue';
import TogglePalette from '@/components/ui/TogglePalette.vue';

const { auth, meta } = inject('app');
const { i18n } = inject('intl');

const op = ref();

const toggle = (event) => {
    op.value.toggle(event);
};

const showingNavigationDropdown = ref(false);
</script>
