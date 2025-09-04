import { createApp } from 'vue'
// import './style.css'
import App from './App.vue'
import { createMemoryHistory, createRouter, createWebHistory } from 'vue-router'

import HomeView from './pages/HomeView.vue'
import AboutView from './pages/AboutView.vue'
import ProductosView from './pages/producto/ProductosView.vue'

const routes = [
  { path: '/', component: HomeView },
  { path: '/about', component: AboutView },
  { path: '/productos', component: ProductosView },
  { path: '/productos/crear', component: () => import('./pages/producto/ProductosCreate.vue') },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

createApp(App).use(router).mount('#app')
