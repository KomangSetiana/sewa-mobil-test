<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="flex min-h-screen flex-col items-center bg-blue-200 pt-6 sm:justify-center sm:pt-0">
        <div>
            <Link href="/">
            <img src="../../../public/logo.png" class="w-32 fill-current text-gray-900" />
            </Link>
        </div>

        <div class="mt-6 w-full overflow-hidden bg-blue-900 px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg">
            <slot />
        </div>
    </div>
</template>
