<script setup>
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';
import Swal from 'sweetalert2';

const apiKey = import.meta.env.VITE_API_KEY;
const router = useRouter();

const loading = ref(true);

const restaurantes = ref([])

async function getRestaurantes() {
  try {
    const response = await fetch('http://127.0.0.1:8000/api/restaurantes/', {
      method: 'GET',
      headers: {
        'X-API-KEY': apiKey,
      }
    });

    const data = await response.json();

    restaurantes.value = data.data;

    if (!response.ok) {
      throw new Error('Error obteniendo los restaurantes');

      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'No se pudieron obtener los restaurantes'
      });
    }
  } catch (error) {
    console.error('Error:', error);
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'No se pudieron obtener los restaurantes'
    });
  } finally {
    loading.value = false;
  }
}

function verRestaurante(id) {
  router.push({ name: 'ver-restaurante', params: { id } });
}

onMounted(() => {
  getRestaurantes();
})

</script>

<template>

  <div v-if="loading" class="text-center mt-7">
    <div class="spinner-border text-success" role="status">
      <span class="visually-hidden">Cargando...</span>
    </div>
  </div>

  <div class="flex flex-wrap gap-8 justify-center py-8">
    <div v-for="restaurante in restaurantes" :key="restaurante.id"
      class="w-80 h-96 flex flex-col justify-between rounded-xl shadow-lg p-4 bg-white">
      <div class="h-40 flex items-center justify-center">
        <img src="@/assets/restauranteIMG.jpg" alt="Imagen genérica de restaurante"
          class="h-full object-contain rounded-xl border-2 border-green-300 shadow" />
      </div>
      <div>
        <p class="text-center font-bold text-emerald-700 text-lg line-clamp-2 h-12">{{ restaurante.nombre }}</p>
        <p class="text-center font-medium text-green-600 mt-2">Ubicación: {{ restaurante.direccion }}</p>
        <p class="text-center font-medium text-green-600 mt-2">Teléfono: {{ restaurante.telefono }}</p>
      </div>
      <div class="flex justify-center mt-4">
        <button @click="verRestaurante(restaurante.id)"
          class="px-5 py-2 rounded-full bg-emerald-500 text-white font-semibold shadow hover:bg-emerald-600 transition-colors duration-200">
          Ver restaurante
        </button>
      </div>
    </div>
  </div>
</template>
