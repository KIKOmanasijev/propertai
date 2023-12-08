<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';

import {useForm} from '@inertiajs/vue3'

const form = useForm({
    location: null,
    images: null,
})

function submit() {
    form.post('/upload');
}
</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">AI AirBnb description generator</h2>
        </template>

        <div class="container mx-auto my-12">
            <div class="grid grid-cols-2 gap-12">
                <div class="bg-white rounded-xl">
                    <form @submit.prevent="submit" class="flex flex-col space-y-4 px-4 py-2">
                        <div>
                            <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Property Location</label>
                            <input type="text" v-model="form.location" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"/>
                        </div>

                        <div class="mt-2 sm:col-span-2 sm:mt-0">
                            <div class="flex max-w-2xl justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                <div class="text-center" v-if="!form.images">
                                    <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                                    </svg>
                                    <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                        <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                            <span>Upload a file</span>
                                            <input id="file-upload" name="file-upload" @change="form.images = $event.target.files" type="file" class="sr-only" multiple>
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                                </div>
                                <div v-else class="space-y-2">
                                    <p class="border border-gray-100 py-1 px-2 rounded-md" v-for="(image, id) in form.images" :key="id">
                                        {{image.name}}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <button class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" type="submit">
                            Submit
                        </button>
                    </form>
                </div>
                <div class="prose prose-md bg-white rounded-xl px-4 py-2" v-html="$page.props.flash.message ?? `<div class='flex items-center justify-center'><p>Your AI property description will appear here</p></div>`">
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
