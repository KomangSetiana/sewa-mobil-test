<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const { props } = usePage();
const cars = ref(props.rentals.data);


console.log(cars.value)
const form = useForm({});





const returnCar = (carId) => {
    if (confirm('Apakah Anda yakin ingin retur mobil ini?')) {
        form.put(route('rentals.returnCar', carId), {
            onSuccess: () => {
                // Hapus mobil dari data lokal
                cars.value = cars.value;
            },
            onError: (errors) => {
                console.error('Gagal retur mobil:', errors);
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
                    Pinjaman
                </h2>
                <Link :href="route('cars.index')"
                    class="rounded-lg border border-blue-900  py-1 px-2 md:py-2 md:px-6 mr-2 font-semibold text-gray-800 hover:bg-blue-600">
                Daftar Mobil
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
                                    {{ car.car.brand }}
                                </p>
                            </div>
                        </div>
                        <!-- Model -->
                        <div class="flex flex-col items-start sm:items-center sm:flex-1 sm:justify-center text-center">
                            <p class="text-slate-500 text-sm">Model</p>
                            <h3 class="text-blue-900 text-lg sm:text-xl font-bold">
                                {{ car.car.model }}
                            </h3>
                        </div>
                        <!-- Plate Number -->
                        <div class="flex flex-col items-start sm:items-center sm:flex-1 sm:justify-center text-center">
                            <p class="text-slate-500 text-sm">Disewa oleh</p>
                            <h3 class="text-blue-900 text-lg sm:text-xl font-bold">
                                {{ car.user.name }}
                            </h3>
                        </div>
                        <!-- Rental Price -->
                        <div class="flex flex-col items-start sm:items-center sm:flex-1 sm:justify-center text-center">
                            <p class="text-slate-500 text-sm">Lama Sewa</p>
                            <h3 class="text-blue-900 text-lg sm:text-xl font-bold">
                                {{ car.total_days }} hari
                            </h3>
                        </div>
                        <!-- Is Available -->
                        <div class="flex flex-col items-start sm:items-center sm:flex-1 sm:justify-center text-center">
                            <p class="text-slate-500 text-sm">Harga Total</p>
                            <h3 class="text-blue-900 text-lg sm:text-xl font-bold">
                                {{ car.total_cost }}
                            </h3>
                        </div>
                        <!-- Actions -->
                        <div class="flex flex-row gap-4">

                            <button @click="returnCar(car.id)" :disabled="car.status === 'returned'"
                                class="py-2 px-4 bg-orange-500 text-white font-bold rounded-lg text-sm sm:text-base transition-colors"
                                :class="{ 'hover:bg-orange-700': car.status !== 'returned', 'opacity-50 cursor-not-allowed': car.status === 'returned' }">
                                {{ car.status === 'active' ? 'Return' : 'Returned' }}
                            </button>
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