<script setup>
import { ref } from 'vue'
import SideBar from './Sidebar.vue'
import TopBar from './TopBar.vue'

const showSideMenuInMobile = ref(false)

</script>

<template>
    <TopBar @show-sidemenu="(eventValue) => showSideMenuInMobile = eventValue"/>

    <SideBar :showSideMenuInMobile="showSideMenuInMobile" />
    
    <div class="p-4 sm:ml-64">
        <div class="p-4 dark:border-gray-700 mt-14">
            <slot />
        </div>
    </div>

</template>
