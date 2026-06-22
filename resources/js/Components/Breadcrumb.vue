<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    items: {
        type: Array,
        required: true,
        // Example: [{ label: 'Dashboard', href: '/dashboard' }, { label: 'Usuarios' }]
    }
});
</script>

<template>
    <nav class="flex mb-4" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li v-for="(item, index) in items" :key="index" class="inline-flex items-center">
                
                <!-- Separator icon for items after the first one -->
                <div v-if="index > 0" class="flex items-center">
                    <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </div>

                <template v-if="item.href">
                    <Link :href="item.href" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-600 transition-colors" :class="{'ml-1 md:ml-2': index > 0}">
                        <!-- Home icon for the first item -->
                        <svg v-if="index === 0" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        {{ item.label }}
                    </Link>
                </template>
                <template v-else>
                    <span class="text-sm font-bold text-gray-800" :class="{'ml-1 md:ml-2': index > 0}">
                        <svg v-if="index === 0" class="w-4 h-4 mr-2 inline" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        {{ item.label }}
                    </span>
                </template>
                
            </li>
        </ol>
    </nav>
</template>
