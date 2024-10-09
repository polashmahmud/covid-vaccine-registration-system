<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
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

                <span v-if="$page.props.auth.user" class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                    Status: <span class="font-semibold">{{ $page.props.auth.user?.registration.status }}</span>
                </span>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        Search for a vaccine center to register for a vaccine.
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
