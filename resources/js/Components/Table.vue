<template>
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto border-collapse border border-gray-800 bg-white">
            <thead>
                <tr>
                    <th v-for="(header, index) in headers" :key="index"
                        class="px-4 py-2 text-left text-white bg-blue-900 border-b border-blue-400">
                        <span>{{ header.label }}</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, rowIndex) in data" :key="rowIndex" class="hover:bg-blue-200">
                    <td v-for="(header, colIndex) in headers" :key="colIndex"
                        class="px-4 py-2 border-b border-gray-800">
                        <slot :name="header.key" :value="item[header.key]" :item="item">
                            {{ item[header.key] }}
                        </slot>
                        <template>
                            <slot></slot>
                        </template>
                    </td>
                </tr>
                <tr v-if="data.length === 0">
                    <td colspan="100%" class="px-4 py-2 text-center text-gray-500">
                        No data available
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
const props = defineProps({
    data: {
        type: Array,
        required: true,
    },
    headers: {
        type: Array,
        required: true,
        default: () => [],
    },
});
</script>