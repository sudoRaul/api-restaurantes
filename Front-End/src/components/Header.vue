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
	<ul class="items-stretch hidden space-x-3 lg:flex ms-5">
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
      <!--
	  <li class="flex">
		<router-link
		  to="/"
		  rel="noopener noreferrer"
		  class="flex items-center px-4 -mb-1 border-b-2"
		  :class="$route.path === '/' ? 'border-violet-600 text-violet-600 dark:border-violet-600 dark:text-violet-600' : 'border-transparent dark:border-transparent'"
		>Link</router-link>
	  </li>-->
	</ul>
	  <div class="flex items-center md:space-x-4">
		<div class="relative">
		  <span class="absolute inset-y-0 left-0 flex items-center pl-2">
			<button type="submit" title="Search" class="p-1 focus:outline-none focus:ring">
			  <svg fill="currentColor" viewBox="0 0 512 512" class="w-4 h-4 dark:text-gray-800">
				<path d="M479.6,399.716l-81.084-81.084-62.368-25.767A175.014,175.014,0,0,0,368,192c0-97.047-78.953-176-176-176S16,94.953,16,192,94.953,368,192,368a175.034,175.034,0,0,0,101.619-32.377l25.7,62.2L400.4,478.911a56,56,0,1,0,79.2-79.195ZM48,192c0-79.4,64.6-144,144-144s144,64.6,144,144S271.4,336,192,336,48,271.4,48,192ZM456.971,456.284a24.028,24.028,0,0,1-33.942,0l-76.572-76.572-23.894-57.835L380.4,345.771l76.573,76.572A24.028,24.028,0,0,1,456.971,456.284Z"></path>
			  </svg>
			</button>
		  </span>
		  <input type="search" name="Search" placeholder="Search..." class="w-32 py-2 me-10 pl-10 text-sm rounded-md sm:w-auto focus:outline-none dark:bg-gray-100 dark:text-gray-800 focus:dark:bg-gray-50">
		</div>
	  </div>
	  <button title="Open menu" type="button" class="p-4 lg:hidden" @click="isMenuOpen = !isMenuOpen">
		<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 dark:text-gray-800">
		  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
		</svg>
	  </button>
	</div>
	
	<ul v-if="isMenuOpen" class="flex flex-col space-y-2 p-4 lg:hidden bg-gray-100 dark:bg-gray-200">
	  <li><router-link to="/" class="block px-4 py-2">Home</router-link></li>
	  <li><router-link to="/cart" class="block px-4 py-2">Cart</router-link></li>
	  <li><router-link to="/" class="block px-4 py-2">Link</router-link></li>
	</ul>
  </header>
</template>