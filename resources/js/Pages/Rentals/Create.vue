<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue'

const form = useForm({
    start_date: '',
    end_date: ''
});

const { props } = usePage();
const car = ref(props.car);

console.log(car)

const submit = () => {
    form.post(route('rentals.store', car.value.id), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <GuestLayout>

        <Head title="Sewa Mobil" />

        <header>
            <h2 class="text-lg font-medium text-white">
                Sewa Mobil
            </h2>

            <p class="mt-1 text-sm text-white mb-4">
                Melakukan penyewaan mobil
            </p>
        </header>


        <form @submit.prevent="submit">
            <div>
                <InputLabel for="start_date" value="Tanggal Mulai Sewa" />

                <TextInput id="start_date" type="date" class="mt-1 block w-full" v-model="form.start_date" required
                    autofocus autocomplete="start_date" />

                <InputError class="mt-2" :message="form.errors.start_date" />
            </div>

            <div class="mt-4">
                <InputLabel for="end_date" value="Tanggal Akhir Sewa" />

                <TextInput id="end_date" type="date" class="mt-1 block w-full" v-model="form.end_date" required
                    autocomplete="end_date" />

                <InputError class="mt-2" :message="form.errors.end_date" />
            </div>




            <div class="mt-4 flex items-center justify-end">


                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Tambahkan
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
