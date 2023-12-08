<template>
    <AuthenticatedLayout>

    <template #header>
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ property.location }}</h2>
        </div>
    </template>

    <div class="mx-auto container py-16 sm:px-6 sm:py-24 lg:grid lg:grid-cols-2 lg:gap-x-8 lg:px-8">
            <!-- Product details -->
            <div class="lg:max-w-lg lg:self-end">
                <section class="mt-4 prose prose-lg" v-html="property.description">
                </section>
            </div>

            <!-- Product image -->
            <div class="mt-10 lg:col-start-2 lg:row-span-2 lg:mt-0">
                <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-lg">
                    <img :src="property.images[0]" class="h-full w-full object-cover object-center" />
                </div>
                <div class="grid grid-cols-3 mt-4" v-if="property.images.slice(1)">
                    <img class="rounded-md" v-for="image in property.images.slice(1)" :src="image" alt="">
                </div>
            </div>

    </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

defineProps({
    property: Object
})
</script>
