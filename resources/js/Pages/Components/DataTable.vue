<script setup>
import { computed, ref } from 'vue';

// Props
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
    stripedRows: {
        type: [Boolean, null],
    },
    stripedColumns: {
        type: [Boolean, null],
    },
    tableHover: {
        type: [Boolean, null],
    },
    perPage: {
        type: [String, null],
    },
})

// Reactive States
const currentPage = ref(1);

const totalPages = computed(() => Math.ceil(props.data.length / props.perPage))

// Computed Properties
const columns = computed(() => Object.fromEntries(Object.entries(props.columns).filter(([key, value]) => !value.hidden ?? false)))

const paginatedItems = computed(() => props.data.slice(parseInt(parseInt(currentPage.value - 1) * parseInt(props.perPage)), parseInt(parseInt(start) + parseInt(props.perPage))));

const updateCurrentPage = (value) => {
    if (currentPage.value + value < 1 || currentPage.value + value > totalPages.value) return
    currentPage.value += value
}
const setCurrentPage = (value) => {
    currentPage.value = value
}

</script>

<template>
    <div class="relative overflow-x-auto border rounded-lg shadow">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                <tr>
                    <th v-for="(column, key) in columns" :key="key" scope="col" class="px-6 py-3"
                        v-html="(column.label ?? key).replaceAll('_', ' ')" />

                    <th v-if="$slots['col-actions']" scope="col" class="px-6 py-3">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="row in paginatedItems" :key="row.id" class="border-b" :class="{
                    'odd:bg-white even:bg-gray-100': striped === 'rows' || stripedRows,
                    'hover:bg-gray-100': tableHover
                }">
                    <template v-for="(column, key) in columns" :key="key">
                        <td class="px-6 py-4" :class="{
                            'odd:bg-white even:bg-gray-100': striped === 'columns' || stripedColumns
                        }">
                            <slot :name="'col-' + key" :data="row">
                                {{ row[key] ?? '-' }}
                            </slot>
                        </td>

                    </template>

                    <td v-if="$slots['col-actions']" class="px-6 py-4" :class="{
                        'odd:bg-white even:bg-gray-100': striped === 'columns' || stripedColumns
                    }">
                        <slot name="col-actions" :data="row" />
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="p-3 flex justify-end" v-if="props.perPage">
            <nav aria-label="Page navigation example">
                <ul class="inline-flex -space-x-px gap-2 text-sm">
                    <li v-on:click="updateCurrentPage(-1)">
                        <a class="paginate-item">Previous</a>
                    </li>

                    <li v-for="page in totalPages" :key="page" v-on:click="setCurrentPage(page)">
                        <a class="paginate-item" :class="{
                            'paginate-item-active': currentPage === page,
                            'hover:bg-gray-100 hover:text-gray-700': currentPage !== page
                        }">{{ page }}</a>
                    </li>

                    <li v-on:click="updateCurrentPage(1)">
                        <a class="paginate-item">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<style scoped>
.paginate-item {
    @apply flex items-center justify-center px-3 h-8 leading-tight border rounded-lg cursor-pointer;
}

.paginate-item-active {
    @apply bg-indigo-600 text-white;
}
</style>