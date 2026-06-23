<script setup>
import { ref, watch, onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const showSuccess = ref(false);
const showError = ref(false);
const successMessage = ref('');
const errorMessage = ref('');

const triggerMessages = () => {
    if (page.props.flash?.success) {
        successMessage.value = page.props.flash.success;
        showSuccess.value = true;
        setTimeout(() => { showSuccess.value = false; }, 5000);
    }
    if (page.props.errors?.error) {
        errorMessage.value = page.props.errors.error;
        showError.value = true;
        setTimeout(() => { showError.value = false; }, 5000);
    }
};

onMounted(() => {
    triggerMessages();
});

// Re-trigger when props change (Inertia visits)
watch(() => page.props.flash?.success, () => triggerMessages());
watch(() => page.props.errors?.error, () => triggerMessages());
</script>

<template>
    <div>
        <Transition enter-active-class="transition ease-out duration-300" enter-from-class="opacity-0 -translate-y-2" enter-to-class="opacity-100 translate-y-0" leave-active-class="transition ease-in duration-200" leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 -translate-y-2">
            <div v-if="showSuccess" class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative flex justify-between items-center shadow-sm" role="alert">
                <span class="block sm:inline">{{ successMessage }}</span>
                <button @click="showSuccess = false" class="text-green-700 hover:text-green-900 focus:outline-none ml-4">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </Transition>

        <Transition enter-active-class="transition ease-out duration-300" enter-from-class="opacity-0 -translate-y-2" enter-to-class="opacity-100 translate-y-0" leave-active-class="transition ease-in duration-200" leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 -translate-y-2">
            <div v-if="showError" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative flex justify-between items-center shadow-sm" role="alert">
                <span class="block sm:inline">{{ errorMessage }}</span>
                <button @click="showError = false" class="text-red-700 hover:text-red-900 focus:outline-none ml-4">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </Transition>
    </div>
</template>
