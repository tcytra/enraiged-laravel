<template>
    <nav class="nav top bg-bluegray-100 border-bluegray-200 border-bottom-1">
        <div class="inline cursor-pointer hover:bg-bluegray-50"
            @click="$emit('toggle-menu')">
            <i class="pi pi-bars"></i>
        </div>
        <div class="block" />
        <div class="inline cursor-pointer hover:bg-bluegray-50">
            <Link href="/logout" method="delete" as="button" class="p-button p-component text-900">
                <i class="pi pi-sign-out"></i>
            </Link>
        </div>
        <!--
        <div class="inline cursor-pointer hover:bg-bluegray-50"
            :class="{ 'bg-white': authOpen }"
            @click="$emit('toggle-auth')">
            <i class="pi pi-user"></i>
        </div>
        -->
    </nav>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Link,
    },
    props: {
        authOpen: Boolean,
    },
};
</script>
