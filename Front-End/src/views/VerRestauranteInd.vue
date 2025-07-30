<script setup>
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';
import Swal from 'sweetalert2';
import router from "@/router";


const route = useRoute();
const apikey = import.meta.env.VITE_API_KEY;
const idRestaurante = route.params.id;
const loading = ref(true);

const restaurante = ref({});
const showModal = ref(false);

// Formulario de actualización
const form = ref({
    nombre: '',
    direccion: '',
    telefono: ''
});

async function getRestaurante() {
    try {
        const response = await fetch(`http://127.0.0.1:8000/api/restaurantes/${idRestaurante}`, {
            method: 'GET',
            headers: {
                'X-API-KEY': apikey
            }
        });

        const data = await response.json();
        restaurante.value = data.data;

        // Rellena el formulario con los datos existentes
        form.value = {
            nombre: data.data?.nombre || '',
            direccion: data.data?.direccion || '',
            telefono: data.data?.telefono || ''
        };

        if (!response.ok) {
            throw new Error('Error obteniendo el restaurante');
            
        }
    } catch (error) {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se pudo obtener el restaurante'
        });
    } finally {
        loading.value = false;
    }
}

function abrirModal() {
    showModal.value = true;
}

function cerrarModal() {
    showModal.value = false;
}

async function actualizarRestaurante() {
    loading.value = true;
    try {
        const response = await fetch(`http://127.0.0.1:8000/api/restaurantes/${idRestaurante}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-API-KEY': apikey
            },
            body: JSON.stringify(form.value)
        });

        if (!response.ok) {
            throw new Error('Error actualizando el restaurante');
        }

        const data = await response.json();
        restaurante.value = data.data;

        Swal.fire({
            icon: 'success',
            title: 'Actualizado',
            text: 'El restaurante se actualizó correctamente'
        });

        cerrarModal();
    } catch (error) {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se pudo actualizar el restaurante, revise los datos ingresados'
        });
    } finally {
        loading.value = false;
    }
}

async function eliminarRestaurante(id) {

    const confirmacion = await Swal.fire({
        title: "¿Seguro que desea eliminar este restaurante?",
        text: "Esta acción no se puede deshacer.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar",
    })

    if (!confirmacion.isConfirmed) {
        return;
    }

    try {
        const response = await fetch(`http://127.0.0.1:8000/api/restaurantes/${idRestaurante}`, {
            method: 'DELETE',
            headers: {
                'X-API-KEY': apikey
            }
        })

        if (!response.ok) {
            throw new Error('Error eliminando el restaurante');
        }
    } catch (error) {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se pudo eliminar el restaurante'
        });
    } finally {
        Swal.fire({
            icon: 'success',
            title: 'Eliminado',
            text: 'El restaurante se eliminó correctamente'
        });
        // Redirigir a la vista de inicio después de eliminar el restaurante
        router.push({ name: 'home' });
    }
}

onMounted(() => {
    getRestaurante();
});
</script>

<template>
    <div v-if="loading" class="text-center mt-7">
        <div class="spinner-border text-success" role="status">
            <span class="visually-hidden">Cargando...</span>
        </div>
    </div>

    <div v-else class="flex flex-col md:flex-row items-center justify-center gap-8 py-12">

        <div class="w-full md:w-1/3 flex justify-center">
            <img src="@/assets/restauranteIMG.jpg" alt="Imagen restaurante"
                class="rounded-2xl shadow-lg border-4 border-emerald-300 w-80 h-80 object-cover" />
        </div>

        <div class="w-full md:w-2/3 bg-white rounded-xl shadow-lg p-8 flex flex-col gap-4">
            <h2 class="text-3xl font-bold text-emerald-700 mb-2">{{ restaurante.nombre }}</h2>
            <p class="text-lg text-green-600"><span class="font-semibold">Dirección:</span> {{ restaurante.direccion }}
            </p>
            <p class="text-lg text-green-600"><span class="font-semibold">Teléfono:</span> {{ restaurante.telefono }}
            </p>
            <div class="flex gap-4 mt-6">
                <button @click="abrirModal"
                    class="px-6 py-2 rounded-full bg-emerald-500 text-white font-semibold shadow hover:bg-emerald-600 transition-colors duration-200">
                    Actualizar
                </button>
                <button @click="eliminarRestaurante(restaurante.id)"
                    class="px-6 py-2 rounded-full bg-red-600 text-white font-semibold shadow hover:bg-gray-300 transition-colors duration-200">
                    Eliminar
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Tailwind -->
    <div v-if="showModal" class="fixed inset-0 z-50 flex items-center justify-center">

        <div class="absolute inset-0 pointer-events-none"></div>
        <div class="bg-white rounded-xl shadow-lg p-8 w-full max-w-md relative z-10">
            <h3 class="text-xl font-bold text-emerald-700 mb-4">Actualizar Restaurante</h3>
            <form @submit.prevent="actualizarRestaurante" class="flex flex-col gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                    <input v-model="form.nombre" type="text"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-400"
                        required />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Dirección</label>
                    <input v-model="form.direccion" type="text"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-400"
                        required />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                    <input v-model="form.telefono" type="text"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-400"
                        required />
                </div>
                <div class="flex gap-4 mt-4">
                    <button type="submit"
                        class="px-6 py-2 rounded-full bg-emerald-500 text-white font-semibold shadow hover:bg-emerald-600 transition-colors duration-200">
                        Guardar
                    </button>
                    <button type="button" @click="cerrarModal"
                        class="px-6 py-2 rounded-full bg-gray-200 text-emerald-700 font-semibold shadow hover:bg-gray-300 transition-colors duration-200">
                        Cancelar
                    </button>
                </div>
            </form>
            <button @click="cerrarModal"
                class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-xl">&times;</button>
        </div>
    </div>
</template>