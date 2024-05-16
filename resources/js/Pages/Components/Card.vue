<template>
    <div class="card">
        <div v-if="$slots.header" class="card-header">
            <slot name="header" />
        </div>

        <div v-if="$slots.default" class="card-content">
            <slot />
        </div>

        <div v-if="$slots.footer" class="card-footer">
            <slot name="footer" />
        </div>
    </div>
</template>

<style scoped>
.card {
    @apply rounded-md shadow-sm ring-1 ring-slate-300;
}

.card-header {
    @apply border-b-2 p-3 flex;
}

.card-content {
    @apply p-3;
}

.card-footer {
    @apply p-3;
}
</style>