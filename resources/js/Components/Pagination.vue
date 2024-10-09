<script setup>
import {Link} from "@inertiajs/vue3";

defineProps({
    pagination: Object
})
</script>

<template>


    <nav aria-label="Page navigation example">
        <ul class="flex items-center h-8 -space-x-px text-sm">
            <li
                v-for="link in pagination.links"
                :key="link.label"
            >
                <Link
                    v-html="link.label"
                    :href="link.url ?? ''"
                    class="flex items-center justify-center h-8 px-3 leading-tight transition border bg-slate-900 border-slate-700 text-slate-200 hover:bg-slate-800 hover:text-white"
                    :class="{'bg-slate-500 border-slate-700 hover:bg-slate-500 cursor-not-allowed' : link.active, 'opacity-50': !link.url}"
                />
            </li>
        </ul>
    </nav>
</template>
