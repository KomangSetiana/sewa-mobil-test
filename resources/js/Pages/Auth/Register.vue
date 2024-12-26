<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    address: '',
    phone_number: '',
    driver_license_number: ''
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>

        <Head title="Register" />

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Nama" />

                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                    autocomplete="name" />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                    autocomplete="username" />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                    autocomplete="new-password" />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />

                <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                    v-model="form.password_confirmation" required autocomplete="new-password" />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>
            <div>
                <InputLabel for="address" value="Alamat" />

                <TextInput id="address" type="text" class="mt-1 block w-full" v-model="form.address" required
                    autocomplete="address" />

                <InputError class="mt-2" :message="form.errors.address" />
            </div>
            <div>
                <InputLabel for="phone_number" value="Nomor Telepon" />

                <TextInput id="phone_number" type="text" class="mt-1 block w-full" v-model="form.phone_number" required
                    autocomplete="phone_number" />

                <InputError class="mt-2" :message="form.errors.phone_number" />
            </div>
            <div>
                <InputLabel for="driver_license_number" value="Nomor SIM" />

                <TextInput id="driver_license_number" type="text" class="mt-1 block w-full"
                    v-model="form.driver_license_number" required autocomplete="driver_license_number" />

                <InputError class="mt-2" :message="form.errors.driver_license_number" />
            </div>

            <div class="mt-4 flex items-center justify-end">
                <Link :href="route('login')"
                    class="rounded-md text-sm text-white underline hover:text-orange-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Already registered?
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
