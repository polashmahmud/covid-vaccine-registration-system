<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
import Notification from "@/Components/Notification.vue";
import axios from "axios";
import {computed, ref, watch} from "vue";
import UserDetails from "@/Components/UserDetails.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";

const users = ref([])
const searchValue = ref('')
const errorMessage = ref('')

const search = async (value) => {
    try {
        const {data} = await axios.get(route('home', {search: value}));
        users.value = data;
    } catch {
        users.value = [];
    }
};

watch(searchValue, (value) => {
    const length = value.length;

    if (length === 17) {
        search(value);
    } else {
        users.value = [];
    }

    if (length > 0 && length !== 17) {
        errorMessage.value = length < 17
            ? 'Invalid NID number'
            : 'NID number should be 17 digits';
    } else {
        errorMessage.value = '';
    }
});

const noUserFound = computed(() => {
    return errorMessage.value === '' && users.value.length === 0 && searchValue.value.length === 17
})
</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">

                <h2
                    class="text-xl font-semibold leading-tight text-gray-800"
                >
                    Covid Vaccine Registration System
                </h2>

                <span v-if="$page.props.auth.user"
                      class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                    Status: <span class="font-semibold">{{ $page.props.auth.user?.registration.status }}</span>
                </span>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <Notification v-if="$page.props.auth?.user"/>
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <TextInput
                            id="nid"
                            type="tel"
                            class="mt-1 block w-full"
                            v-model="searchValue"
                            placeholder="Search by 17 digit NID number"
                        />

                        <InputError class="mt-2" :message="errorMessage"/>
                    </div>
                </div>
                <div class="mt-4">
                    <UserDetails
                        v-if="users.length"
                        v-for="user in users"
                        :key="user.id"
                        :user="user"
                    />
                    <div v-if="noUserFound">
                        <div class="p-6 text-gray-900">
                            <p class="text-center">
                                No user found, please search by 17 digit NID number to get user details or
                                <Link class="text-blue-500 hover:text-blue-600" :href="`/register?nid=${searchValue}`">register
                                </Link>
                                for vaccine.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
