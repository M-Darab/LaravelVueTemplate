<script setup>
import AppLayout from '../Layouts/App.vue'
import { Card, DataTable } from '../../Components'

defineOptions({ layout: AppLayout })

defineProps(['users'])

</script>

<template>
    <DataTable :data="users"></DataTable>
</template>

<style lang="scss" scoped></style>