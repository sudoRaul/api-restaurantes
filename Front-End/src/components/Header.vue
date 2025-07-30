<script setup>
import { ref } from 'vue';
const isMenuOpen = ref(false);
</script>

<template>
  <header class="p-4 dark:bg-gray-100 dark:text-gray-800">
	<div class="container flex justify-between h-16 mx-auto">
	  <router-link rel="noopener noreferrer" to="/" aria-label="Back to homepage" class="flex items-center p-2 ms-10">
		<img src="/restaurante.png" alt="Logotipo" class="w-15">
	  </router-link>
	<ul class="items-stretch hidden space-x-3 lg:flex">
	  <li class="flex">
		<router-link
		  to="/"
		  rel="noopener noreferrer"
		  class="flex items-center px-4 -mb-1 border-b-2"
		  :class="$route.path === '/' ? 'border-violet-600 text-violet-600 dark:border-violet-600 dark:text-violet-600' : 'border-transparent dark:border-transparent'"
		>Home</router-link>
	  </li>
	  <li class="flex">
		<router-link
		  to="/crear-restaurante"
		  rel="noopener noreferrer"
		  class="flex items-center px-4 -mb-1 border-b-2"
		  :class="$route.path === '/crear-restaurante' ? 'border-violet-600 text-violet-600 dark:border-violet-600 dark:text-violet-600' : 'border-transparent dark:border-transparent'"
		>Crear Restaurante</router-link>
	  </li>
      
	</ul>
	  <div class="flex items-center md:space-x-4">
		
	  </div>
	  <button title="Open menu" type="button" class="p-4 lg:hidden" @click="isMenuOpen = !isMenuOpen">
		<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 dark:text-gray-800">
		  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
		</svg>
	  </button>
	</div>
	
	<ul v-if="isMenuOpen" class="flex flex-col space-y-2 p-4 lg:hidden bg-gray-100 dark:bg-gray-200">
	  <li><router-link to="/" class="block px-4 py-2">Home</router-link></li>
	  <li><router-link to="/crear-restaurante" class="block px-4 py-2">Crear Restaurante</router-link></li>
	</ul>
  </header>
</template>