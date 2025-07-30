<script setup>
import { onMounted, ref, computed } from 'vue';
import { useRouter } from 'vue-router';
import Swal from 'sweetalert2';

const apiKey = import.meta.env.VITE_API_KEY;
const router = useRouter();

const loading = ref(true);

const restaurantes = ref([])
const currentPage = ref(1);
const perPage = 4;

const totalPages = computed(() => Math.ceil(restaurantes.value.length / perPage));
const paginatedRestaurantes = computed(() => {
  const start = (currentPage.value - 1) * perPage;
  return restaurantes.value.slice(start, start + perPage);
});

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
    currentPage.value = 1;

    if (!response.ok) {
      throw new Error('Error obteniendo los restaurantes');
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

  <div class="flex flex-wrap gap-15 justify-center py-8">
    <div v-for="restaurante in paginatedRestaurantes" :key="restaurante.id"
      class="w-120 h-96 flex flex-col justify-between rounded-xl shadow-lg p-4 bg-white">
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

  <!-- Paginación Tailwind -->
  <div v-if="totalPages > 1" class="flex justify-center mt-8">
    <nav class="inline-flex -space-x-px">
      <button
        class="px-3 py-2 rounded-l-lg border border-gray-300 bg-blue-500 text-white hover:bg-blue-400"
        :disabled="currentPage === 1"
        @click="currentPage--"
      >Anterior</button>
      <button
        v-for="page in totalPages" :key="page"
        class="px-3 py-2 border border-gray-300 font-semibold transition-colors duration-200"
        :class="currentPage === page ? 'bg-emerald-300 text-white shadow-lg' : 'bg-white text-blue-700 hover:bg-emerald-100'"
        @click="currentPage = page"
      >{{ page }}</button>
      <button
        class="px-3 py-2 rounded-r-lg border border-gray-300 bg-blue-500 text-white hover:bg-blue-400"
        :disabled="currentPage === totalPages"
        @click="currentPage++"
      >Siguiente</button>
    </nav>
  </div>
</template>
