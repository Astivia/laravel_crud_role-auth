<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    totalUsers: {
        type: Number,
        default: 0
    },
    rolesList: {
        type: Array,
        default: () => []
    }
});

const page = usePage();
const user = computed(() => page.props.auth.user);

// Formatear la fecha actual: dd/mm/aaaa
const today = new Date().toLocaleDateString('es-ES', { 
    day: '2-digit', 
    month: '2-digit', 
    year: 'numeric' 
});

// Lógica para mostrar máximo 4 roles
const visibleRoles = computed(() => props.rolesList.slice(0, 4));
const hiddenRolesCount = computed(() => Math.max(0, props.rolesList.length - 4));

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Panel de Control</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <!-- Welcome Card matched to Auth style -->
                <div class="bg-white shadow-lg sm:rounded-xl overflow-hidden border border-gray-100 mb-6">
                    <div class="p-8 sm:p-10">
                        
                        <!-- Header Section of the Card -->
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6 mb-8">
                            <div>
                                <h3 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-1">Bienvenido, {{ user.name || ''}}</h3>
                                <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">hoy es {{ today }}</p>
                            </div>
                            
                            <!-- Logo Icon matching auth views -->
                            <div class="w-14 h-14 bg-[#1e2333] rounded-lg shadow-sm flex items-center justify-center shrink-0">
                                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                            </div>
                        </div>

                        <!-- Content Section -->
                        <div class="border-t border-gray-100 pt-8">
                            <p class="text-gray-600 mb-8 text-base">
                                Has iniciado sesión exitosamente en el sistema de gestión. Selecciona una opción del menú para comenzar o utiliza los accesos directos a continuación.
                            </p>
                            
                            <div v-if="user.role_names && user.role_names.includes('admin')" class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-4">
                                
                                <!-- Card 1: Usuarios -->
                                <div class="border border-gray-100 rounded-2xl p-6 bg-white hover:shadow-xl transition-shadow relative overflow-hidden group flex flex-col">
                                    <!-- Background watermark -->
                                    <div class="absolute -bottom-4 -right-4 text-gray-50 opacity-40 group-hover:scale-110 group-hover:-translate-y-2 group-hover:-translate-x-2 transition-all duration-500 pointer-events-none">
                                        <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path></svg>
                                    </div>
                                    <div class="relative z-10 flex flex-col h-full">
                                        <div class="flex justify-between items-start mb-4">
                                            <div class="w-12 h-12 rounded-xl bg-[#dcfce7] text-[#166534] flex items-center justify-center">
                                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                            </div>
                                            <span class="px-3 py-1 text-xs font-bold bg-[#ecfdf5] text-[#047857] rounded-full text-center leading-none flex items-center">Estadística</span>
                                        </div>
                                        <h4 class="text-lg font-bold text-gray-900 mb-1">Gestión de Usuarios</h4>
                                        <div class="text-[40px] leading-tight font-extrabold text-[#006b54] mb-3">{{ totalUsers }}</div>
                                        <p class="text-sm text-gray-500 mb-6">Usuarios registrados en la plataforma.</p>
                                        
                                        <Link :href="route('users.index')" class="mt-auto w-full inline-flex justify-center items-center py-2.5 px-4 bg-[#e6f0fa] hover:bg-[#d0e3f5] text-[#0056b3] font-bold rounded-lg text-sm transition-colors">
                                            Ir al catálogo
                                            <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                        </Link>
                                    </div>
                                </div>

                                <!-- Card 2: Roles -->
                                <div class="border border-gray-100 rounded-2xl p-6 bg-white hover:shadow-xl transition-shadow relative overflow-hidden group flex flex-col">
                                    <div class="absolute -bottom-4 -right-4 text-gray-50 opacity-40 group-hover:scale-110 group-hover:-translate-y-2 group-hover:-translate-x-2 transition-all duration-500 pointer-events-none">
                                        <svg class="w-32 h-32" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                    </div>
                                    <div class="relative z-10 flex flex-col h-full">
                                        <div class="flex justify-between items-start mb-4">
                                            <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                            </div>
                                            <span class="px-3 py-1 text-xs font-bold bg-indigo-50 text-indigo-600 rounded-full text-center leading-none flex items-center">{{ rolesList.length }} Roles Activos</span>
                                        </div>
                                        <h4 class="text-lg font-bold text-gray-900 mb-4">Control de Roles</h4>
                                        <div class="flex flex-wrap gap-2 mb-6">
                                            <span v-for="role in visibleRoles" :key="role.name" class="px-2.5 py-1 text-xs font-bold border border-gray-200 text-gray-600 rounded-md bg-gray-50 capitalize">
                                                {{ role.name }}
                                            </span>
                                            <span v-if="hiddenRolesCount > 0" class="px-2.5 py-1 text-xs font-bold text-gray-400 self-center">
                                                +{{ hiddenRolesCount }} más
                                            </span>
                                        </div>
                                        
                                        <Link :href="route('roles.index')" class="mt-auto w-full inline-flex justify-center items-center py-2.5 px-4 bg-[#e6f0fa] hover:bg-[#d0e3f5] text-[#0056b3] font-bold rounded-lg text-sm transition-colors">
                                            Gestionar roles
                                            <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                        </Link>
                                    </div>
                                </div>

                                <!-- Card 3: Permisos -->
                                <div class="border border-gray-100 rounded-2xl p-6 bg-white hover:shadow-xl transition-shadow relative overflow-hidden group flex flex-col">
                                    <div class="absolute -bottom-4 -right-4 text-gray-50 opacity-40 group-hover:scale-110 group-hover:-translate-y-2 group-hover:-translate-x-2 transition-all duration-500 pointer-events-none">
                                        <svg class="w-32 h-32" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                    </div>
                                    <div class="relative z-10 flex flex-col h-full">
                                        <div class="flex justify-between items-start mb-4">
                                            <div class="w-12 h-12 rounded-xl border border-gray-200 text-gray-500 flex items-center justify-center bg-gray-50">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                            </div>
                                            <div class="flex -space-x-3">
                                                <div class="w-7 h-7 rounded-full bg-gray-200 border-2 border-white"></div>
                                                <div class="w-7 h-7 rounded-full bg-gray-300 border-2 border-white"></div>
                                                <div class="w-7 h-7 rounded-full bg-[#8f9bb3] border-2 border-white"></div>
                                            </div>
                                        </div>
                                        <h4 class="text-lg font-bold text-gray-900 mb-2">Matriz de Permisos</h4>
                                        <p class="text-sm text-gray-500 mb-6">Configura niveles de acceso granulares para cada funcionalidad del sistema.</p>
                                        <div class="mb-8">
                                            <div class="w-full bg-gray-100 rounded-full h-2">
                                                <div class="bg-[#10b981] h-2 rounded-full" style="width: 85%"></div>
                                            </div>
                                        </div>
                                        
                                        <Link :href="route('permissions.index')" class="mt-auto w-full inline-flex justify-center items-center py-2.5 px-4 bg-[#e6f0fa] hover:bg-[#d0e3f5] text-[#0056b3] font-bold rounded-lg text-sm transition-colors">
                                            Configurar accesos
                                            <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                                        </Link>
                                    </div>
                                </div>

                            </div>
                        </div>
                        
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
