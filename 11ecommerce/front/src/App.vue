<template>
  <!-- <h1>Hello App!</h1>
  <p><strong>Current route path:</strong> {{ $route.fullPath }}</p> -->
  <nav>
    <RouterLink to="/">Principal</RouterLink>
    <RouterLink to="/productos">Productos</RouterLink>
  </nav>
  <main>
    <RouterView />
  </main>
</template>
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