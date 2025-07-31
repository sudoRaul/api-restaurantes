<script setup>
import { defineProps } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();

// Definimos las props para personalizar el componente
defineProps({
  mensaje: String,
  submensaje: String,
  mostrarBoton: {
    type: Boolean,
    default: true
  },
  textoBoton: {
    type: String,
    default: "Volver al inicio"
  },
  destino: {
    type: String,
    default: "/"
  }
});
</script>


<template>
    <div class="no-data-container text-center flex flex-col items-center justify-center">
      <h2 class="mt-3 text-2xl font-bold text-emerald-700">¡Ups! Algo inesperado ocurrió</h2>
      <img src="https://st5.depositphotos.com/24385730/75059/v/450/depositphotos_750596166-stock-illustration-striking-eating-symbol-featuring-crossed.jpg" alt="No hay datos" class="my-6 rounded-xl shadow-lg border-2 border-green-200" style="max-width: 350px;">
      <h3 class="mt-3 text-lg font-semibold text-green-600">{{ mensaje || "No hay información disponible" }}</h3>
      <p class="text-gray-500 mb-6">{{ submensaje || "Intente buscar en otra fecha o vuelva en otro momento." }}</p>
      <button v-if="mostrarBoton"
        class="px-6 py-2 rounded-full bg-emerald-500 text-white font-semibold shadow hover:bg-emerald-600 transition-colors duration-200 mb-5"
        @click="router.push(destino)">
        {{ textoBoton }}
      </button>
    </div>
  </template>
  
 
  
  <style scoped>
  .no-data-container {
    margin-top: 50px;
  }
  </style>
  