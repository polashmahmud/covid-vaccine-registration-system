<script setup>
defineProps({
    user: Object
})
</script>

<template>
    <div
        class="p-6 border-b border-gray-200 bg-white"
    >
        <div class="md:flex justify-between">
            <div class="w-1/2">
                <p tabindex="0" class="focus:outline-none text-sm leading-normal text-gray-500 dark:text-gray-200">
                    Name</p>
                <div class="pt-5 flex items-center">
                    <div>
                        <p class="focus:outline-none text-sm font-medium leading-5 text-gray-800 dark:text-white ">
                            {{ user.name }}</p>
                        <p class="focus:outline-none text-xs leading-3 pt-2 text-gray-500 dark:text-gray-200  ">{{ user.email }}</p>
                    </div>
                </div>
                <p class="focus:outline-none text-sm leading-normal pt-9 text-gray-500 dark:text-gray-200  ">
                    National ID Number
                </p>
                <p class="focus:outline-none text-sm leading-normal pt-5 text-gray-800 dark:text-white ">
                    {{ user.nid }}
                </p>
            </div>
            <div class="w-1/2 md:pl-12 md:pt-0 pt-4">
                <p class="focus:outline-none text-sm leading-normal text-gray-500 dark:text-gray-200">
                    Vaccine Center Information
                </p>
                <p class="focus:outline-none text-sm leading-normal pt-5 text-gray-800 dark:text-white ">
                    {{ user.registration.scheduled_date }}
                </p>
                <p class="focus:outline-none text-xs leading-3 pt-2 text-gray-500 dark:text-gray-200  ">
                    {{ user.registration.vaccineCenter?.name }} ({{ user.registration.vaccineCenter?.location }})
                </p>
                <p class="focus:outline-none text-sm leading-normal pt-9 text-gray-500 dark:text-gray-200  ">Status</p>
                <p class="focus:outline-none text-sm font-bold leading-normal text-green-700 pt-5">
                    {{ user.registration.status }}
                </p>
            </div>
        </div>
    </div>
</template>
