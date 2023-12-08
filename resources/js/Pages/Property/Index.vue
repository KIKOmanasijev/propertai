<template>
<AuthenticatedLayout>
    <template #header>
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Your properties</h2>
            <Link
                class="py-2 px-4 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700"
                :href="route('properties.create')">
                Add Property
            </Link>
        </div>
    </template>

    <div class="container mx-auto py-12">
        <div id="properties" class="space-y-4">
            <div v-for="property in properties.reverse()"
                 :key="property.id"
                 class="bg-white rounded-md px-2 py-1.5 border border-gray-200"
            >
                <h2 class="text-2xl">
                    <span class="font-bold">Property Location:</span>
                    {{ property.location }}
                </h2>

                <div class="flex space-x-2">
                    <Link :href="route('properties.destroy', property.id)"
                          method="delete"
                          class="bg-red-700 text-white px-2 py-1 rounded-md text-sm mt-2 inline-block"
                    >
                        Delete Property
                    </Link>
                    <Link :href="route('properties.show', property.id)"
                          class="bg-indigo-100 text-indigo-800 px-2 py-1 rounded-md text-sm mt-2 inline-block"
                    >
                        View Property
                    </Link>
                </div>
            </div>
        </div>
    </div>
</AuthenticatedLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

defineProps({
    properties: Array
});
</script>


<style scoped>

</style>
