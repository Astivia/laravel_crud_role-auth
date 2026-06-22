<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Iniciar Sesión" />

    <div class="min-h-screen flex flex-col sm:justify-center items-center bg-[#f4f6f9] pt-6 sm:pt-0">
        
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <div class="w-full sm:max-w-md bg-white shadow-lg sm:rounded-xl overflow-hidden p-8 sm:p-10 border border-gray-100 relative">
            
            <!-- Logo Icon -->
            <div class="flex justify-center mb-6">
                <div class="w-14 h-14 bg-[#1e2333] rounded-lg shadow-sm"></div>
            </div>

            <!-- Headers -->
            <div class="text-center mb-8">
                <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-2">Iniciar Sesión</h2>
                <p class="text-[13px] sm:text-sm text-gray-500">Ingresa tus credenciales para acceder al sistema</p>
            </div>

            <!-- Form -->
            <form @submit.prevent="submit" class="space-y-6">
                
                <!-- Email -->
                <div>
                    <label for="email" class="block text-[10px] sm:text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                        Correo Electrónico
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <input
                            id="email"
                            type="email"
                            class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm py-2.5 text-gray-700 placeholder-gray-400"
                            v-model="form.email"
                            placeholder="ejemplo@correo.com"
                            required
                            autofocus
                            autocomplete="username"
                        />
                    </div>
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-[10px] sm:text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                        Contraseña
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input
                            id="password"
                            type="password"
                            class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm py-2.5 text-gray-700 placeholder-gray-400 font-mono tracking-widest"
                            v-model="form.password"
                            placeholder="••••••••"
                            required
                            autocomplete="current-password"
                        />
                    </div>
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <!-- Options -->
                <div class="flex items-center justify-between mt-4">
                    <label class="flex items-center">
                        <Checkbox name="remember" v-model:checked="form.remember" class="text-blue-600 focus:ring-blue-500 border-gray-300 rounded" />
                        <span class="ms-2 text-xs sm:text-sm text-gray-600">Recuérdame</span>
                    </label>

                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="text-xs sm:text-sm font-medium text-blue-600 hover:text-blue-500"
                    >
                        ¿Olvidé mi contraseña?
                    </Link>
                </div>

                <!-- Submit -->
                <div class="pt-2">
                    <button
                        type="submit"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        class="w-full flex justify-center items-center py-2.5 px-4 border border-transparent rounded-md shadow-sm text-sm font-bold text-white bg-[#0056b3] hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors"
                    >
                        Entrar
                        <svg class="ml-2 -mr-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </div>

                <!-- Divider -->
                <div class="mt-8 border-t border-gray-100 pt-6">
                    <p class="text-center text-[13px] sm:text-sm text-gray-500">
                        ¿No tienes una cuenta? 
                        <Link :href="route('register')" class="font-bold text-blue-600 hover:text-blue-500">Regístrate</Link>
                    </p>
                </div>
            </form>
        </div>
    </div>
</template>
