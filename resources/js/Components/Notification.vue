<script setup>
import {usePage, Link} from "@inertiajs/vue3";

const notification = usePage().props.auth.user?.registration;

</script>

<template>
    <div
        v-if="notification.status === 'Scheduled'"
        class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
    >
        <div class="flex items-center justify-between">
            <div>
                <p class="font-semibold">You have a scheduled appointment for the vaccine.</p>
                <p class="text-xs">Center: {{ notification.vaccineCenter.name }}</p>
                <p class="text-xs">Address: {{ notification.vaccineCenter.location }}</p>
                <p class="text-xs">Date: {{ notification.scheduled_date }}</p>
            </div>
            <Link
                :href="route('vaccine-schedule.index')"
                class="text-blue-800 font-semibold hover:underline dark:text-blue-400"
            >
                View Details
            </Link>
        </div>
    </div>
    <div
         v-if="notification.status === 'Vaccinated'"
            class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
    >
        <div class="flex items-center justify-between">
            <div>
                <p class="font-semibold">You have been vaccinated.</p>
                <p class="text-xs">Center: {{ notification.vaccineCenter.name }}</p>
                <p class="text-xs">Address: {{ notification.vaccineCenter.location }}</p>
                <p class="text-xs">Date: {{ notification.scheduled_date }}</p>
            </div>
        </div>
    </div>
</template>
