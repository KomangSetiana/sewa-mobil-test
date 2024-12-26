<template>
    <nav class="container mx-auto flex items-center justify-between py-4 px-6">
        <a href="#" class="flex-shrink-0">
            <img src="../../../public/Logo.svg" alt="Logo">
        </a>
        <ul class="hidden md:flex items-center gap-8">
            <li v-for="item in menuItems" :key="item.label">
                <a :href="item.href" class="transition duration-300 font-medium hover:text-orange-500"
                    :class="item.active ? 'font-semibold text-orange-500' : 'text-white'">
                    {{ item.label }}
                </a>
            </li>
        </ul>
        <div class="hidden md:flex items-center gap-3">
            <!-- Menampilkan Dashboard jika user dapat login -->
            <template v-if="canLogin">
                <Link href="#" v-if="$page.props.auth.user"
                    class="rounded-full py-2 px-6 bg-orange-500 font-semibold text-white hover:shadow-lg transition duration-300">
                Dashboard
                </Link>
            </template>
            <!-- Menampilkan Sign In dan Sign Up jika user tidak dapat login -->
            <template v-else>
                <a href="#" class="rounded-full border border-white py-2 px-6 font-semibold text-white">
                    Sign In
                </a>
                <a href="#" v-if="canRegister"
                    class="rounded-full py-2 px-6 bg-orange-500 font-semibold text-white hover:shadow-lg transition duration-300">
                    Sign Up
                </a>
            </template>
        </div>



        <!-- <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end">
                        <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        Dashboard
                        </Link>

                        <template v-else>
                            <Link :href="route('login')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                            Log in
                            </Link>

                            <Link v-if="canRegister" :href="route('register')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                            Register
                            </Link>
                        </template>
</nav> -->
        <button @click="toggleMobileMenu" class="md:hidden text-white text-2xl">
            ☰
        </button>
        <div v-if="isMobileMenuOpen"
            class="absolute top-16 left-0 w-full bg-gray-800 text-white flex flex-col items-center py-4 md:hidden">
            <ul>
                <li v-for="item in menuItems" :key="item.label" class="py-2">
                    <a :href="item.href" class="text-lg">
                        {{ item.label }}
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
export default {
    data() {
        return {
            isMobileMenuOpen: false,
            menuItems: [
                { label: 'Home', href: '#', active: true },
                { label: 'Features', href: '#' },
                { label: 'Benefits', href: '#' },
                { label: 'Stories', href: '#' },
                { label: 'About', href: '#' },
            ],
        };
    },
    methods: {
        toggleMobileMenu() {
            this.isMobileMenuOpen = !this.isMobileMenuOpen;
        },
    },
};
</script>

<style>
/* Custom styles if needed */
</style>