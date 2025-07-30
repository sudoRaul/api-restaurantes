import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/VerTodosRestaurantes.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/crear-restaurante',
      name: 'crear-restaurante',
      component: () => import('../views/CrearRestaurante.vue'),
    },
    {
      path: '/ver-restaurante/:id',
      name: 'ver-restaurante',
      component: () => import('../views/VerRestauranteInd.vue')
    }
  ],
})

export default router
