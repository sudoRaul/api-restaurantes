<script setup>
import { ref } from 'vue';
import Swal from 'sweetalert2';

const loading = ref(false);
const form = ref({
  nombre: '',
  direccion: '',
  telefono: ''
});

async function crearRestaurante() {
  loading.value = true;
  try {
    const response = await fetch('http://127.0.0.1:8000/api/restaurantes/', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-API-KEY': import.meta.env.VITE_API_KEY
      },
      body: JSON.stringify(form.value)
    });

    if (!response.ok) {
      throw new Error('Error creando el restaurante');
    }

    Swal.fire({
      icon: 'success',
      title: 'Creado',
      text: 'El restaurante se creó correctamente'
    });
    form.value = { nombre: '', direccion: '', telefono: '' };
  } catch (error) {
    console.error('Error:', error);
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'No se pudo crear el restaurante, por favor, revise los datos ingresados'
    });
  } finally {
    loading.value = false;
  }
}
</script>

<template>
  <div class="flex flex-col items-center justify-center min-h-[70vh] py-10 bg-gradient-to-br from-green-50 to-white">
    <div class="bg-white rounded-2xl shadow-2xl border border-green-200 p-8 w-full max-w-lg">
      <h2 class="text-3xl font-bold text-emerald-700 mb-6 text-center">Crear Restaurante</h2>
      <form @submit.prevent="crearRestaurante" class="flex flex-col gap-5">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
          <input v-model="form.nombre" type="text" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-400" required />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Dirección</label>
          <input v-model="form.direccion" type="text" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-400" required />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
          <input v-model="form.telefono" type="text" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-400" required />
        </div>
        <button type="submit" :disabled="loading" class="mt-4 px-6 py-2 rounded-full bg-emerald-500 text-white font-semibold shadow hover:bg-emerald-600 transition-colors duration-200 disabled:opacity-60 disabled:cursor-not-allowed">
          {{ loading ? 'Creando...' : 'Crear Restaurante' }}
        </button>
      </form>
    </div>
  </div>
</template>