<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, computed } from 'vue';

const props = defineProps({
    items: Array,
});

const search = ref(''); // bind dit aan de input

// computed property om items te filteren
const filteredItems = computed(() => {
    if (!search.value) return props.items;

    const term = search.value.toLowerCase();

    return props.items.filter(item => {
        return (
            item.name.toLowerCase().includes(term) ||
            String(item.osrs_id).includes(term) ||
            String(item.value).includes(term) ||
            String(item.highalch).includes(term) ||
            String(item.lowalch).includes(term) ||
            String(item.limit).includes(term)
        );
    });
});

const syncItems = () => {
    router.post(route('items.sync'));
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
           <div class="flex items-center justify-between">
             <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard
            </h2>
            <button
                @click="syncItems"
                class="ml-4 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150"
            >
                Sync Items
            </button>
           </div>

        </template>

        

        <!-- loop through the filtered items and showcase them nicely -->
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <!-- make a search input -->
                <div class="py-4">
                    <input
                        type="text"
                        placeholder="Search items..."
                        v-model="search"
                        class="w-full px-4 py-2 border rounded-md"
                    />
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    <div
                        v-for="item in filteredItems"
                        :key="item.id"
                        class="p-4 bg-white rounded-lg shadow-md border border-gray-200"
                    >
                        <h3 class="text-lg font-semibold text-gray-900">
                            {{ item.name }}
                        </h3>
                        <p class="text-gray-600">OSRS ID: {{ item.osrs_id }}</p>
                        <p class="text-gray-600">Members: {{ item.members ? 'Yes' : 'No' }}</p>
                        <p class="text-gray-600">Value: {{ item.value }}</p>
                        <p class="text-gray-600">High Alch: {{ item.highalch }}</p>
                        <p class="text-gray-600">Low Alch: {{ item.lowalch }}</p>
                        <p class="text-gray-600">Limit: {{ item.limit }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- show the raw data -->
        <!-- <pre>{{ JSON.stringify(items, null, 2) }}</pre> -->
    </AuthenticatedLayout>
</template>
