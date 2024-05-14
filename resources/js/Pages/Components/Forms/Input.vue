<script setup>

const model = defineModel()

</script>


<template>
    <div>
        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
        <div class="relative shadow rounded-md border">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center px-3 rounded-md bg-red-400">
                <span class="text-gray-500 sm:text-sm">$</span>
            </div>
            <input type="text" v-model="model" class="block w-full rounded-md p-2.5 px-9 ">
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 rounded-md bg-red-400">
                <span class="text-gray-500 sm:text-sm">$</span>
            </div>
        </div>
    </div>
</template>
