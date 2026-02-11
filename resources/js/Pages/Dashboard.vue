<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';



</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                
                    <div class="p-6 bg-white  rounded-xl shadow-md border border-gray-200 max-w-lg mx-auto mt-8">
                        <h1 class="text-2xl font-bold text-gray-900  mb-2">
                            Welcome to Project Tim!
                        </h1>
                        <p class="text-gray-700 ">
                            Your dashboard is ready.
                        </p>
                        <p class="mt-4 text-gray-600 ">
                            Project Tim is <span class="font-semibold">The Ideal Merchant</span> for Old School RuneScape.
                        </p>
                    </div>
                
            </div>
        </div>
    </AuthenticatedLayout>
</template>
