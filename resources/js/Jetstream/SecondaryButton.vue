<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-blue-400 border border-gray-300 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:text-white focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-white active:bg-blue-500 disabled:opacity-25 transition">
        <slot />
    </button>
</template>
