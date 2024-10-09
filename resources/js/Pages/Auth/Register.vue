<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    centers: {
        type: Object,
        required: true,
    }
})
const form = useForm({
    name: '',
    nid: '',
    vaccine_center_id: '',
    email: '',
    password: '',
    password_confirmation: '',
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
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"

                    autofocus
                    autocomplete="name"
                    placeholder="Enter your full name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    autocomplete="username"

                    placeholder="Enter your email address"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="nid" value="NID" />

                <TextInput
                    id="nid"
                    type="tel"
                    class="mt-1 block w-full"
                    v-model="form.nid"
                    v-mask="'#################'"

                    placeholder="Enter your NID number"
                />

                <InputError class="mt-2" :message="form.errors.nid" />
            </div>

            <div class="mt-4">
                <InputLabel for="vaccine_center" value="Vaccine Center" />

                <select
                    id="vaccine_center"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    v-model="form.vaccine_center_id"

                >
                    <option value="">Select Vaccine Center</option>
                    <option
                        v-for="center in centers"
                        :key="center.id"
                        :value="center.id"
                    >
                        {{ center.name }} ({{ center.location }})
                    </option>
                </select>

                <InputError class="mt-2" :message="form.errors.vaccine_center_id" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    autocomplete="new-password"

                    placeholder="Enter your password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="password_confirmation"
                    value="Confirm Password"
                />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    autocomplete="new-password"

                    placeholder="Confirm your password"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.password_confirmation"
                />
            </div>

            <div class="mt-4 flex items-center justify-end">
                <Link
                    :href="route('login')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Already registered?
                </Link>

                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
