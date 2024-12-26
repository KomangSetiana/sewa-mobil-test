<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    brand: "",
    model: "",
    license_plate: "",
    daily_rate: "",
});

const submit = () => {
    form.post(route('cars.store'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <GuestLayout>

        <Head title="Tambah Mobil" />

        <header>
            <h2 class="text-lg font-medium text-white">
                Tambah Mobil
            </h2>

            <p class="mt-1 text-sm text-white mb-4">
                Menambahkan mobil untuk disewakan
            </p>
        </header>


        <form @submit.prevent="submit">
            <div>
                <InputLabel for="brand" value="Merek" />

                <TextInput id="brand" type="text" class="mt-1 block w-full" v-model="form.brand" required autofocus
                    autocomplete="brand" />

                <InputError class="mt-2" :message="form.errors.brand" />
            </div>

            <div class="mt-4">
                <InputLabel for="model" value="Model" />

                <TextInput id="model" type="text" class="mt-1 block w-full" v-model="form.model" required
                    autocomplete="model" />

                <InputError class="mt-2" :message="form.errors.model" />
            </div>

            <div class="mt-4">
                <InputLabel for="license_plate" value="Plate Mobil" />

                <TextInput id="license_plate" type="text" class="mt-1 block w-full" v-model="form.license_plate"
                    required autocomplete="license_plate" />

                <InputError class="mt-2" :message="form.errors.license_plate" />
            </div>

            <div class="mt-4">
                <InputLabel for="daily_rate" value="Harga Sewa/hari" />

                <TextInput id="daily_rate" type="text" class="mt-1 block w-full" v-model="form.daily_rate" required
                    autocomplete="daily_rate" />

                <InputError class="mt-2" :message="form.errors.daily_rate" />
            </div>


            <div class="mt-4 flex items-center justify-end">


                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Tambahkan
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
