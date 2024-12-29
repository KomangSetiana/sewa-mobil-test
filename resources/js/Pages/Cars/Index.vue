<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage, router } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';

const { props } = usePage();
const cars = ref(props.cars);
const form = useForm({
    search: '',
});




const handleFilter = () => {
    form.get(route('cars.index'));
};




const deleteCar = (carId) => {
    if (confirm('Apakah Anda yakin ingin menghapus mobil ini?')) {
        form.delete(route('cars.destroy', carId), {
            onSuccess: () => {

                cars.value = cars.value.filter(car => car.id !== carId);
            },
            onError: (errors) => {
                console.error('Gagal menghapus mobil:', errors);
            },
        });
    }
};


</script>

<template>

    <Head title="Car" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Mobil
                </h2>

                <form @submit.prevent="handleFilter" class="flex items-center max-w-sm mr-4">
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <fa :icon="['fas', 'magnifying-glass']" style="color: #B197FC;" />
                        </div>
                        <input type="text" v-model="form.search" id="simple-search"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full ps-10 p-2.5 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-sky-500 dark:focus:border-sky-500"
                            placeholder="Search name..." />
                    </div>
                    <button type="submit"
                        class="py-2 px-3 ms-2 text-sm font-medium text-white bg-sky-800 rounded-lg hover:bg-sky-700 focus:ring-4 focus:outline-none focus:ring-sky-300 dark:bg-sky-600 dark:hover:bg-sky-700 dark:focus:ring-sky-800">
                        <fa :icon="['fas', 'magnifying-glass']" />
                        Cari
                    </button>
                </form>
                <Link :href="route('cars.create')"
                    class="rounded-lg border border-blue-900  py-1 px-2 md:py-2 md:px-6 mr-2 font-semibold text-gray-800 hover:bg-blue-600">
                Tambah Mobil
                </Link>
            </div>

        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">
                <template v-for="car in cars" :key="car.id">
                    <div
                        class="item-card flex flex-col sm:flex-row sm:justify-between sm:items-center gap-6 bg-white p-6 shadow-lg rounded-lg hover:shadow-xl transition-shadow duration-300">
                        <!-- Image and Brand -->
                        <div class="flex flex-row items-center gap-x-4">
                            <img src="https://via.placeholder.com/120x90" alt="Car Image"
                                class="rounded-lg object-cover w-[100px] h-[75px] sm:w-[140px] sm:h-[105px]">
                            <div class="flex flex-col">
                                <h3 class="text-indigo-800 text-lg sm:text-xl font-bold">
                                    Merek
                                </h3>
                                <p class="text-slate-600 text-sm">
                                    {{ car.brand }}
                                </p>
                            </div>
                        </div>
                        <!-- Model -->
                        <div class="flex flex-col items-start sm:items-center sm:flex-1 sm:justify-center text-center">
                            <p class="text-slate-500 text-sm">Model</p>
                            <h3 class="text-blue-900 text-lg sm:text-xl font-bold">
                                {{ car.model }}
                            </h3>
                        </div>
                        <!-- Plate Number -->
                        <div class="flex flex-col items-start sm:items-center sm:flex-1 sm:justify-center text-center">
                            <p class="text-slate-500 text-sm">Plate Nomor</p>
                            <h3 class="text-blue-900 text-lg sm:text-xl font-bold">
                                {{ car.license_plate }}
                            </h3>
                        </div>
                        <!-- Rental Price -->
                        <div class="flex flex-col items-start sm:items-center sm:flex-1 sm:justify-center text-center">
                            <p class="text-slate-500 text-sm">Harga Sewa</p>
                            <h3 class="text-blue-900 text-lg sm:text-xl font-bold">
                                {{ car.daily_rate }} /hari
                            </h3>
                        </div>
                        <!-- Is Available -->
                        <div class="flex flex-col items-start sm:items-center sm:flex-1 sm:justify-center text-center">
                            <p class="text-slate-500 text-sm">Ketersediaan</p>
                            <h3 class="text-blue-900 text-lg sm:text-xl font-bold">
                                {{ car.is_available ? 'Tersedia' : 'Masih Disewa' }}
                            </h3>
                        </div>
                        <!-- Actions -->
                        <div class="flex flex-row gap-4">
                            <Link :href="route('cars.edit', car.id)"
                                class="py-2 px-4 bg-indigo-700 text-white font-bold rounded-lg text-sm sm:text-base hover:bg-indigo-800 transition-colors">
                            Edit
                            </Link>


                            <button @click="deleteCar(car.id)"
                                class="py-2 px-4 bg-red-600 text-white font-bold rounded-lg text-sm sm:text-base hover:bg-red-700 transition-colors">
                                Delete
                            </button>
                            <Link :href="route('rentals.create', car.id)" :disabled="car.is_available === 0"
                                class="py-2 px-4 bg-green-500 text-white font-bold rounded-lg text-sm sm:text-base transition-colors"
                                :class="{ 'hover:bg-green-700': car.is_available === 1, 'opacity-50 cursor-not-allowed': car.is_available == 0 }">

                            Sewa
                            </Link>
                        </div>
                    </div>
                </template>
                <div v-if="cars.length === 0">
                    <span class="px-4 py-2 text-center text-gray-500">
                        No data available
                    </span>
                </div>
            </div>
        </div>



    </AuthenticatedLayout>
</template>