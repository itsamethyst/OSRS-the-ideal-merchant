<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, computed } from 'vue';

const props = defineProps({
    items: {
        type: Array,
        required: true
    }
});

const search = ref('');

// Filtered items based on search input
const filteredItems = computed(() => {
    if (!search.value) return props.items;

    const term = search.value.toLowerCase();

    return props.items.filter(item => {
        return (
            item.name.toLowerCase().includes(term) ||
            String(item.osrs_id).startsWith(term) ||
            // margin
            String(item.flip_info.margin).startsWith(term)
        );
    });
});


</script>

<template>
     <Head title="Top OSRS Flips" />

    <AuthenticatedLayout>
        <template #header>
           <div class="flex items-center justify-between">
             <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Top 50 OSRS Flips
            </h2>
           </div>

        </template>
            <div class="py-12">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="bg-gray-100 min-h-screen">

                    <!-- Search input -->
                    <div class="mb-4">
                    <input
                        type="text"
                        placeholder="Search items..."
                        v-model="search"
                        class="w-full px-4 py-2 border rounded-md"
                    />
                    </div>

                    <!-- Flip table -->
                    <table class="min-w-full bg-white shadow rounded">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2 text-left">ID</th>
                            <th class="px-4 py-2 text-left">Item Name</th>
                            <th class="px-4 py-2 text-right">Buy Price</th>
                            <th class="px-4 py-2 text-right">Sell Price</th>
                            <th class="px-4 py-2 text-right">Margin</th>
                            <th class="px-4 py-2 text-right">ROI %</th>
                            <th class="px-4 py-2 text-right">Max Qty</th>
                            <th class="px-4 py-2 text-right">Total Profit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in filteredItems" :key="item.id" class="border-t hover:bg-red-50">
                        <td class="px-4 py-2">{{ item.osrs_id }}</td>
                        <td class="px-4 py-2 flex items-center">
                            <!-- <img :src="item.icon" :alt="item.name" class="w-6 h-6 mr-2"> -->
                            {{ item.name }}
                        </td>
                            <td class="px-4 py-2 text-right">{{ item.flip_info.buy_price }}</td>
                        <td class="px-4 py-2 text-right">{{ item.flip_info.sell_price }}</td>
                        <td class="px-4 py-2 text-right">{{ Number(item.flip_info.margin).toFixed(2) }}</td>
                        <td class="px-4 py-2 text-right">{{ Number(item.flip_info.roi).toFixed(2) }}%</td>
                        <td class="px-4 py-2 text-right">{{ item.flip_info.max_qty }}</td>
                        <td class="px-4 py-2 text-right">{{ Number(item.flip_info.total_profit).toFixed(0) }}</td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>