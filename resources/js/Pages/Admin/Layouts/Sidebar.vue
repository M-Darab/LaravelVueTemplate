<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { reactive, ref } from "vue";
import { faUsers, faAngleRight, faDashboard } from "@fortawesome/free-solid-svg-icons";

defineProps({
	showSideMenuInMobile: Boolean,
});

// States
let activeMenu = ref("");
let dropdownToggle = ref("");

let sideBarMenu = reactive([
	{
		id: "dashboard",
		label: "Dashboard",
		link: route("admin.dashboard"),
		icon: faDashboard,
		children: [],
	},
	{
		id: "users",
		label: "Users",
		icon: faUsers,
		children: [
			{
				label: "View All",
				link: route("admin.users.index"),
			},
			{
				label: "Add New",
				link: route("admin.dashboard"),
			},
		],
	},
]);

// Functions
const extractRoutePath = (routePath) => new URL(routePath).pathname;

const activeMenuHandler = (menu) => {
	activeMenu.value = menu;
};

const dropdownToggleHandler = (dropdown) => {
	dropdownToggle.value = dropdownToggle.value.length > 0 && dropdownToggle.value === dropdown ? "" : dropdown;
	activeMenu.value = dropdown;
};
</script>

<template>
	<aside id="logo-sidebar"
		class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
		:class="{
			'-translate-x-full': !showSideMenuInMobile,
		}" aria-label="Sidebar">
		<div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
			<ul class="space-y-2 font-medium">
				<li v-for="menu in sideBarMenu" :key="menu.id" class="mt-2">
					<Link class="flex items-center p-2 rounded-lg" v-if="!menu.children.length" :class="{
						active: $page.url === extractRoutePath(menu.link),
						'hover:bg-gray-200':
							$page.url !== extractRoutePath(menu.link),
					}" v-on:click="activeMenuHandler(menu.id)" :href="menu.link">
					<font-awesome-icon :icon="menu.icon" class="w-5" />
					<span class="ms-3">{{ menu.label }}</span></Link>

					<template v-if="menu.children.length">
						<button type="button" v-on:click="dropdownToggleHandler(menu.id)"
							class="flex items-center w-full p-2 text-gray-900 transition hover:bg-gray-100"
							aria-controls="users-dropdown" data-collapse-toggle="users-dropdown" :class="{
								'rounded-lg': dropdownToggle !== menu.id,
								'rounded-tl-lg rounded-tr-lg bg-gray-200 hover:bg-gray-200':
									dropdownToggle === menu.id,
							}">
							<font-awesome-icon :icon="faUsers" class="w-5" />

							<span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Users</span>

							<font-awesome-icon class="w-3 h-3 transition" :class="{
								'rotate-90': dropdownToggle === menu.id,
							}" :icon="faAngleRight" />
						</button>
						<ul id="users-dropdown" v-if="dropdownToggle === menu.id"
							class="space-y-2 rounded-bl-lg rounded-br-lg bg-gray-100 overflow-hidden">
							<li class="m-2">
								<Link
									class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 hover:bg-gray-100"
									:class="{
										active:
											$page.url ===
											extractRoutePath(
												route('admin.users.index')
											),
										'hover:bg-gray-200':
											$page.url !==
											extractRoutePath(
												route('admin.users.index')
											),
									}" :href="route('admin.users.index')">View All
								</Link>
							</li>
							<li class="m-2">
								<Link
									class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 hover:bg-gray-100"
									:class="{
										active:
											$page.url ===
											extractRoutePath(
												route('admin.users.create')
											),
										'hover:bg-gray-200':
											$page.url !==
											extractRoutePath(
												route('admin.users.create')
											),
									}" :href="route('admin.users.create')">Add New
								</Link>
							</li>
						</ul>
					</template>
				</li>
			</ul>
		</div>
	</aside>
</template>

<style scoped>
.active {
	@apply text-white bg-indigo-600 shadow;
}
</style>
