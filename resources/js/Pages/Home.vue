<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import Notification from "@/Components/Notification.vue";
import axios from "axios";
import {ref} from "vue";
import UserDetails from "@/Components/UserDetails.vue";

const users = ref([])

const search = (value) => {
    axios.get(route('home', {search: value}))
        .then(response => {
            users.value = response.data
        })
}
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
                        <input
                            type="search"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-100 focus:border-blue-300"
                            placeholder="Search by 17 digit NID number"
                            @input="search($event.target.value)"
                        />
                    </div>
                </div>
                <div class="mt-4">
                    <UserDetails
                        v-for="user in users"
                        :key="user.id"
                        :user="user"
                    />
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
