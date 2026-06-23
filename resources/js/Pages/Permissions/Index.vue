<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const breadcrumbs = [
    { label: 'Dashboard', href: route('dashboard') },
    { label: 'Permisos' }
];

const props = defineProps({
    permissions: {
        type: Array,
        required: true,
    },
});

const form = useForm({});

const deletePermission = (id) => {
    if (confirm('¿Estás seguro de que deseas eliminar este permiso?')) {
        form.delete(route('permissions.destroy', id));
    }
};
</script>

<template>
    <Head title="Permisos" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Gestión de Permisos</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Breadcrumb -->
                <Breadcrumb :items="breadcrumbs" />

                <!-- Notificaciones -->
                <FlashMessage />

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Lista de Permisos</h3>
                        <Link v-if="$page.props.auth.user.permission_names?.includes('permission-create')" :href="route('permissions.create')" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Crear Permiso
                        </Link>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="permission in permissions" :key="permission.id">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ permission.id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ permission.name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ permission.description }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <Link v-if="$page.props.auth.user.permission_names?.includes('permission-edit')" :href="route('permissions.edit', permission.id)" class="text-indigo-600 hover:text-indigo-900 mr-3" title="Editar">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </Link>
                                        <button v-if="$page.props.auth.user.permission_names?.includes('permission-delete')" @click="deletePermission(permission.id)" class="text-red-600 hover:text-red-900" title="Eliminar">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                                <tr v-if="permissions.length === 0">
                                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">No hay permisos registrados.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
