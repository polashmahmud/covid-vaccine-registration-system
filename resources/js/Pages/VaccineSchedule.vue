<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import VaccineCenter from "@/Components/VaccineCenter.vue";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    vaccineCenters: Object,
    vaccineCenter: Object,
})

const form = useForm({
    vaccine_center_id: props.vaccineCenter.vaccineCenter.id,
    vaccine_center_name: props.vaccineCenter.vaccineCenter.name,
    vaccine_center_location: props.vaccineCenter.vaccineCenter.location,
    scheduled_date: props.vaccineCenter.scheduled_date ?? '',
})

const handleSelectVaccineCenter = (center) => {
    form.vaccine_center_id = center.id;
    form.vaccine_center_name = center.name;
    form.vaccine_center_location = center.location;
}

</script>

<template>
    <Head title="Vaccine Schedule"/>

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Vaccine Schedule
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-3">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg p-6 text-gray-900 space-y-3">
                    <h3 class="text-lg font-semibold">
                        1. Vaccine Center
                    </h3>

                    <div class="inline-block bg-gray-200 py-2 px-4 rounded-md">
                        <span class="font-semibold">Name:</span> {{ form.vaccine_center_name }}
                        <br>
                        <span class="font-semibold">Address:</span> {{ form.vaccine_center_location }}
                    </div>

                    <h3 class="text-lg font-semibold">
                        2. Vaccine Schedule Date
                    </h3>

                    <div>
                        <TextInput
                            id="vaccine_center_id"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.scheduled_date"
                            required
                        />

                        <InputError class="mt-2" :message="form.errors.scheduled_date"/>
                    </div>

                    <div>
                        <PrimaryButton>
                            Save
                        </PrimaryButton>
                    </div>
                </div>

                <h3 class="text-lg font-semibold border-t pt-4 mb-4">
                    Other Vaccine Center ({{ vaccineCenters.meta.total }})
                </h3>

                <div class="grid grid-cols-3 gap-3">
                    <VaccineCenter
                        v-for="vaccineCenter in vaccineCenters.data"
                        :key="vaccineCenter.id"
                        :vaccineCenter="vaccineCenter"
                        :selectedVaccineCenterId="form.vaccine_center_id"
                        @selectVaccineCenter="handleSelectVaccineCenter"
                    />
                </div>

                <div class="flex items-center justify-center mt-6">
                    <Pagination :pagination="vaccineCenters.meta" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
