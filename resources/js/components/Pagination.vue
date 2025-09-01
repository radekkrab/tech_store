<template>
    <div v-if="links.length > 3" class="flex justify-center mt-8">
        <div class="flex space-x-1">
            <template v-for="(link, index) in links" :key="index">
                <div
                    v-if="link.url === null"
                    class="px-3 py-2 text-gray-400 border border-gray-300 rounded-md"
                    v-html="link.label"
                />
                <Link
                    v-else
                    class="px-3 py-2 border border-gray-300 rounded-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    :class="{ 'bg-blue-500 text-white border-blue-500': link.active }"
                    :href="link.url"
                    v-html="link.label"
                />
            </template>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
    links: Array
})
</script>
