<script setup>
import AppLayout from '@/Admin/Layouts/App.vue'
import { DataTable } from '@/Components'

defineOptions({ layout: AppLayout })

defineProps(['users'])

let columns = {
    id: {
        label: "ID",
        sortable: false,
        searchable: false,
        sticky: false,
        hidden: false
    },
    name: {
        label: "Name",
        sortable: false,
        searchable: false,
        sticky: false,
        hidden: false
    },
    email: {
        label: "Email",
        sortable: false,
        searchable: false,
        sticky: false,
        hidden: false
    },
    created_at: {
        sortable: false,
        searchable: false,
        sticky: false,
        hidden: false
    }
}

</script>

<template>
    <DataTable :data="users" striped-rows :columns="columns" table-hover per-page="11">
        <template v-slot:col-created_at="{ data }">
            {{ new Date(data.created_at * 1000).toISOString().slice(0, 10)  }}
        </template> 
    </DataTable>
</template>