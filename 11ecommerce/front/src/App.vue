<template>
  <!-- <h1>Hello App!</h1>
  <p><strong>Current route path:</strong> {{ $route.fullPath }}</p> -->
  <nav>
    <RouterLink to="/">Principal</RouterLink>
    <RouterLink to="/productos">Productos</RouterLink>
    <RouterLink to="/roles">Roles</RouterLink>
    <RouterLink to="/permisos">Permisos</RouterLink>
    <RouterLink to="/usuarios">Usuarios</RouterLink>
    <RouterLink to="/almacenes">Almacenes</RouterLink>
    <RouterLink to="/ventas">Ventas</RouterLink>
    <RouterLink to="/login" v-if="!isLoggedIn">Login</RouterLink>
    <span style="color: white;cursor: pointer;" @click="salir()" v-if="isLoggedIn">Logout</span>
  </nav>
  <main>
    <RouterView />
  </main>
</template>
<script>
import axios from 'axios';
export default {
  name: 'App',
  data() {
    return {
      isLoggedIn: false
    };
  },
  mounted() {
    const token = localStorage.getItem('token');
    if (token) {
      axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
      axios.get('http://localhost:8000/api/auth/profile')
        .then(response => {
          console.log('User profile:', response.data);
        })
        .catch(error => {
          console.error('Error fetching user profile:', error);
        });
      this.isLoggedIn = true;
    }
  },
  methods: {
    salir() {
      // localStorage.removeItem('token');
      // axios.defaults.headers.common['Authorization'] = '';
      // this.isLoggedIn = false;
      // alert('Has cerrado sesión');
      // this.$router.push('/login');
      if (confirm('¿Estás seguro de que deseas cerrar sesión?')) {
        axios.post('http://localhost:8000/api/auth/logout')
          .then(() => {
            localStorage.removeItem('token');
            axios.defaults.headers.common['Authorization'] = '';
            this.isLoggedIn = false;
            alert('Has cerrado sesión');
            this.$router.push('/login');
          })
          .catch(error => {
            console.error('Error during logout:', error);
            alert('Error al cerrar sesión: ' + (error.response?.data?.message || error.message));
          });
      }
    }
  }
};
</script>
<style>
nav {
  background-color: #0e467e;
  padding: 1rem;
}

nav a {
  margin: 0 1rem;
  text-decoration: none;
  color: #fff;
}

nav a:hover {
  text-decoration: underline;
}
</style>