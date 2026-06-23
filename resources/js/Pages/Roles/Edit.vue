<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Checkbox from '@/Components/Checkbox.vue';

const props = defineProps({
    role: {
        type: Object,
        required: true,
    },
    permissions: {
        type: Array,
        required: true,
    },
});

// Extract currently assigned permission IDs
const assignedPermissions = props.role.permissions ? props.role.permissions.map(p => p.id) : [];

const form = useForm({
    name: props.role.name,
    description: props.role.description || '',
    is_active: props.role.is_active,
    permissions: assignedPermissions,
});

const submit = () => {
    form.put(route('roles.update', props.role.id));
};
</script>

<template>
    <Head title="Editar Rol" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Rol: {{ role.name }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    
                    <form @submit.prevent="submit" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Left Column: Role Details -->
                            <div class="space-y-6">
                                <div>
                                    <InputLabel for="name" value="Nombre del Rol" />
                                    <TextInput
                                        id="name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.name"
                                        required
                                        autofocus
                                    />
                                    <InputError class="mt-2" :message="form.errors.name" />
                                </div>

                                <div>
                                    <InputLabel for="description" value="Descripción" />
                                    <TextInput
                                        id="description"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.description"
                                    />
                                    <InputError class="mt-2" :message="form.errors.description" />
                                </div>

                                <div>
                                    <label class="flex items-center">
                                        <Checkbox name="is_active" v-model:checked="form.is_active" />
                                        <span class="ms-2 text-sm text-gray-600">Rol Activo</span>
                                    </label>
                                    <InputError class="mt-2" :message="form.errors.is_active" />
                                </div>
                            </div>

                            <!-- Right Column: Permissions Selection -->
                            <div>
                                <InputLabel value="Permisos Asignados" class="mb-3" />
                                <div class="bg-gray-50 p-4 rounded-md border border-gray-200 h-64 overflow-y-auto">
                                    <div v-for="permission in permissions" :key="permission.id" class="mb-2">
                                        <label class="flex items-start">
                                            <input 
                                                type="checkbox" 
                                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 mt-1" 
                                                :value="permission.id"
                                                v-model="form.permissions"
                                            >
                                            <div class="ms-2">
                                                <span class="block text-sm font-medium text-gray-700">{{ permission.name }}</span>
                                                <span class="block text-xs text-gray-500">{{ permission.description }}</span>
                                            </div>
                                        </label>
                                    </div>
                                    <div v-if="permissions.length === 0" class="text-sm text-gray-500 italic">
                                        No hay permisos disponibles.
                                    </div>
                                </div>
                                <InputError class="mt-2" :message="form.errors.permissions" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6 border-t pt-6">
                            <Link :href="route('roles.index')" class="text-sm text-gray-600 hover:text-gray-900 mr-4">
                                Cancelar
                            </Link>

                            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Actualizar Rol
                            </PrimaryButton>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
