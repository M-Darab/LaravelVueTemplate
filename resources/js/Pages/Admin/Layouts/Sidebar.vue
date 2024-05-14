<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
    showSideMenuInMobile: Boolean
})

const extractRoutePath = (routePath) => new URL(routePath).pathname;

</script>
<template>
    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        :class="{
            '-translate-x-full': !showSideMenuInMobile
        }" aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <Link class="flex items-center p-2 rounded-lg dark:text-white dark:hover:bg-gray-700" :class="{
                        'active': $page.url === extractRoutePath(route('admin.dashboard')),
                        'hover:bg-gray-200': !$page.url === extractRoutePath(route('admin.dashboard'))
                    }" :href="route('admin.dashboard')"><span class="ms-3">Dashboard</span></Link>
                </li>
            </ul>
        </div>
    </aside>
</template>


<style scoped>
.active {
    @apply text-white bg-blue-600 shadow;
}
</style>