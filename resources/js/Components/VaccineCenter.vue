<script setup>
defineProps({
    vaccineCenter: Object,
    selectedVaccineCenterId: Number,
})

const emit = defineEmits(['select-vaccine-center'])
</script>

<template>
    <div
        class="inline-block bg-gray-200 py-2 px-4 rounded-md cursor-pointer border"
        :class="selectedVaccineCenterId === vaccineCenter.id ? 'border-blue-500' : 'border-gray-400'"
        @click="emit('select-vaccine-center', vaccineCenter)"
    >
        <span class="font-semibold">Name:</span> {{ vaccineCenter.name }}
        <br>
        <span class="font-semibold">Address:</span> {{ vaccineCenter.location }}
    </div>
</template>

