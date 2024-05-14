<script setup>
import AppLayout from '../Layouts/App.vue'

defineOptions({ layout: AppLayout })

defineProps(['users'])

</script>

<template>

    <div class="relative overflow-x-auto  border rounded-md">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Created At
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Updated At
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(user, index) in users" :key="index"
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-t hover:bg-gray-100">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ user.name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ user.email }}
                    </td>
                    <td class="px-6 py-4">
                        {{ user.created_at }}
                    </td>
                    <td class="px-6 py-4">
                        {{ user.updated_at }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</template>

<style lang="scss" scoped></style>