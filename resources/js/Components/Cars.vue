<template>
    <section class="container mx-auto px-6 mt-12">
        <h2 class="text-2xl font-bold mb-6 text-white">Latest Cars</h2>
        <div class="flex gap-6 overflow-x-auto">
            <div v-for="car in cars" :key="car.id"
                class="min-w-[300px] p-4 bg-white shadow-lg rounded-lg hover:ring-2 hover:ring-orange-500 transition">
                <div class="flex items-center gap-4">
                    <img src="https://via.placeholder.com/300x200?text=Sedan" alt="Logo" class="w-16 h-16">
                    <div>
                        <h3 class="text-lg font-bold">{{ car.model }}</h3>
                        <p class="text-sm">{{ car.brand }}</p>
                    </div>
                </div>
                <hr class="my-4">
                <p class="text-md">Plate Mobil</p>
                <h4 class="text-lg font-bold mb-4">{{ car.license_plate }}</h4>
                <p class="text-sm text-gray-600">{{ car.is_available ? 'Tersedia' : 'Sudah disewa' }}</p>
                <div class="mt-4 flex justify-between items-center">
                    <span class="text-lg font-bold">{{ car.daily_rate }} /hari</span>
                    <Link href="#" class="px-4 py-2 bg-orange-500 text-white rounded-full hover:shadow-lg transition">
                    Sewa
                    </Link>
                </div>
            </div>
        </div>
    </section>
</template>


<script setup>

defineProps({

    cars: {
        type: Array,
        required: true,
    }
})


</script>