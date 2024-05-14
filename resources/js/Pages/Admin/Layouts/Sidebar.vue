<script setup>
import { Link } from '@inertiajs/vue3'
import { ref } from 'vue';
import { faUsers, faAngleDown } from '@fortawesome/free-solid-svg-icons'

defineProps({
    showSideMenuInMobile: Boolean
})

const dropdownToggle = ref('');

const extractRoutePath = (routePath) => new URL(routePath).pathname;

const dropdownToggleHandler = (dropdown) => {
    dropdownToggle.value = dropdownToggle.value.length > 0 && dropdownToggle.value === dropdown ? '' : dropdown
}
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
                        'hover:bg-gray-200': $page.url !== extractRoutePath(route('admin.dashboard'))
                    }" v-on:click="dropdownToggleHandler('dashboard')" :href="route('admin.dashboard')"><span
                        class="ms-3">Dashboard</span></Link>
                </li>
                <li>
                    <button type="button" v-on:click="dropdownToggleHandler('users')"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                        aria-controls="users-dropdown" data-collapse-toggle="users-dropdown" :class="{
                            'rounded-lg': dropdownToggle !== 'users',
                            'rounded-tl-lg rounded-tr-lg bg-gray-200 hover:bg-gray-200': dropdownToggle === 'users'
                        }">

                        <font-awesome-icon :icon="faUsers" />

                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Users</span>

                        <font-awesome-icon class="w-3 h-3 transition ease-in-out" :class="{
                            'rotate-180': dropdownToggle === 'users'
                        }" :icon="faAngleDown" />

                    </button>
                    <ul id="users-dropdown" :class="{
                        hidden: dropdownToggle !== 'users',
                        'rounded-bl-lg rounded-br-lg p-2 bg-gray-100': dropdownToggle === 'users'
                    }" class="py-2 space-y-2">
                        <li>
                            <Link
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 hover:bg-gray-100"
                                :class="{
                                    'active': $page.url === extractRoutePath(route('admin.users.index')),
                                    'hover:bg-gray-200': $page.url !== extractRoutePath(route('admin.users.index'))
                                }" :href="route('admin.users.index')">View All</Link>
                        </li>
                        <li>
                            <Link
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 hover:bg-gray-100"
                                :class="{
                                    'active': $page.url === extractRoutePath(route('admin.users.create')),
                                    'hover:bg-gray-200': $page.url !== extractRoutePath(route('admin.users.create'))
                                }" :href="route('admin.users.create')">Add New</Link>
                        </li>
                    </ul>
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