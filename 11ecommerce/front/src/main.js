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
  { path: '/productos/editar/:id', component: () => import('./pages/producto/ProductosEditar.vue') },
  { path: '/usuarios', component: () => import('./pages/usuarios/UserView.vue') },
  { path: '/usuarios/crear', component: () => import('./pages/usuarios/UserCreate.vue') },
  { path: '/usuarios/:id', component: () => import('./pages/usuarios/UserShow.vue') },
  { path: '/usuarios/editar/:id', component: () => import('./pages/usuarios/UserEdit.vue') },
  { path: '/login', component: () => import('./pages/auth/Login.vue') },

  { path: '/roles', component: () => import('./pages/roles/Roles.vue') },
  { path: '/roles/crear', component: () => import('./pages/roles/RolesCreate.vue') },
  { path: '/roles/:id', component: () => import('./pages/roles/RolesView.vue') },

  { path: '/permisos', component: () => import('./pages/permisos/Permiso.vue') },
  { path: '/permisos/crear', component: () => import('./pages/permisos/PermisoCreate.vue') },
  { path: '/permisos/:id', component: () => import('./pages/permisos/PermisoView.vue') },

  { path: '/almacenes', component: () => import('./pages/almacenes/Almacen.vue') },

]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

createApp(App).use(router).mount('#app')
