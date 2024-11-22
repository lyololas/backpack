<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div
        class="flex min-h-screen flex-col items-center bg-gray-100 pt-6 sm:justify-center sm:pt-0 w-screen"
    >

        <div
            class="mt-6 overflow-hidden bg-white px-6 py-4 sm:max-w-4xl sm:rounded-lg lg:w-1/3 border-lg"
        >
            <slot />
        </div>
    </div>
</template>
