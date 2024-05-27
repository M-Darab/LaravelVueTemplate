<script setup>
import { Link } from '@inertiajs/vue3'
import { computed, useSlots } from 'vue';

const props = defineProps({
    data: {
        required: true,
        type: Object
    },
    columns: {
        required: true,
        type: Object
    },
    striped: {
        type: [String, null],
        validator(value, props) {
            return ['rows', 'columns'].includes(value)
        }
    },
})

const columns = computed(() => Object.fromEntries(Object.entries(props.columns).filter(([key, value]) => !value.hidden ?? false)))

// let [firstLink, lastLink, links] = [props.data.links.shift(), props.data.links.pop(), props.data.links];

</script>

<template>
    <div class="relative overflow-x-auto border rounded-lg shadow">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                <tr>
                    <th v-for="(column, key) in columns" :key="key" scope="col" class="px-6 py-3"
                        v-html="(column.label ?? key).replaceAll('_', ' ')" />
                </tr>
            </thead>
            <tbody>
                <tr v-for="row in props.data" :key="row.id" class="border-b" :class="{
                    'odd:bg-white even:bg-gray-100': striped === 'rows'
                }">
                    <td v-for="(column, key) in columns" :key="key" scope="col" class="px-6 py-4" :class="{
                        'odd:bg-white even:bg-gray-100': striped === 'columns'
                    }">{{ row[key] ?? '-' }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<style scoped></style>