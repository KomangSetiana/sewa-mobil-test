<script setup>
import Header from '@/Components/Header.vue';
import Cars from '@/Components/Cars.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';


const { props } = usePage();

const cars = ref(props.cars);

console.log(cars)

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    cars: {
        type: Array
    },

});


</script>

<template>

    <Head title="Welcome" />
    <section class="bg-blue-900">

        <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
            <div class="flex lg:col-start-2 lg:justify-center">
                <img src="../../../public/logo.png" alt="logo">
            </div>
            <nav v-if="canLogin" class="mx-4 flex flex-1 justify-end">
                <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                    class="rounded-full border border-white py-1 px-2 md:py-2 md:px-6 font-semibold text-white">
                Dashboard
                </Link>

                <template v-else>
                    <Link :href="route('login')"
                        class="rounded-full border border-white  py-1 px-2 md:py-2 md:px-6 mr-2 font-semibold text-white">
                    Log in
                    </Link>

                    <Link v-if="canRegister" :href="route('register')" class="rounded-full  py-1 px-2 md:py-2 md:px-6
                            bg-orange-500 font-semibold text-white hover:shadow-lg transition duration-300">
                    Register
                    </Link>
                </template>
            </nav>
        </header>

        <main class="mt-6">

            <Header />

            <Cars :cars="cars" />
        </main>

        <footer class="bg-blue-950 dark:bg-gray-800 py-8 text-center text-sm text-white  mt-10">
            <div class="max-w-screen-lg mx-auto">
                <p class="font-semibold text-lgtext-white">
                    Rent Car
                </p>
                <p class="mt-2">
                    © 2024 Rent Car. All Rights Reserved.
                </p>
                <div class="mt-4 flex justify-center space-x-4">
                    <a href="#" class="hover:text-blue-500 dark:hover:text-blue-400">Privacy Policy</a>
                    <a href="#" class="hover:text-blue-500 dark:hover:text-blue-400">Terms of Service</a>
                    <a href="#" class="hover:text-blue-500 dark:hover:text-blue-400">Contact Us</a>
                </div>
                <div class="mt-6">
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        Designed with ❤️ by Rent Car Team.
                    </p>
                </div>
            </div>
        </footer>

    </section>
</template>
