<template>
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
    <span style="font-size: 1.5rem;font-weight: bold;">Productos</span>
    <button @click="crearProducto" style="padding: 0.5rem 1rem; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">
      Crear Producto
    </button>
  </div>
  <p>Lista de productos disponibles:</p>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th>Imagen</th>
        <th>Categoria</th>
        <th>Opciones</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="producto in productos" :key="producto.id">
        <td>{{ producto.id }}</td>
        <td>{{ producto.nombre }}</td>
        <td>{{ producto.descripcion }}</td>
        <td>{{ producto.precio_venta_actual }}</td>
        <td>
            <img :src="`http://localhost:8000/imagenes/${producto.imagen}`" alt="Imagen del producto" style="max-width: 45px; max-height: 45px;" v-if="producto.imagen"/>
             <!-- <img :src="`data:image/jpeg;base64,${producto.imagen}`" alt="Imagen del producto" style="max-width: 45px; max-height: 45px;" v-if="producto.imagen"/> -->
        </td>
        <td>{{ producto.categoria.nombre }}</td>
        <td>
          <!-- <button @click="editarProducto(producto.id)">Editar</button> -->
          <button @click="eliminarProducto(producto.id)">Eliminar</button>
        </td>
      </tr>
    </tbody>
  </table>
  <pre>
    {{ productos }}
  </pre>
</template>
<script>
import axios from 'axios';
export default {
  name: 'ProductosView',
  data() {
    return {
      productos: [],
    };
  },
  mounted() {
    this.productosGet();
  },
  methods: {
    async productosGet() {
      axios.get('http://localhost:8000/api/productos')
        .then((response) => {
          this.productos = response.data;
        //   console.log(this.productos);
        })
        .catch((error) => {
          console.error('Error fetching products:', error);
        });
    },
    crearProducto() {
      this.$router.push('/productos/crear');
    },
    eliminarProducto(id) {
      if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
        axios.delete(`http://localhost:8000/api/productos/${id}`)
          .then(() => {
            this.productosGet();
          })
          .catch((error) => {
            console.error('Error deleting product:', error);
          });
      }
    },
  },
};
</script>
<style>
table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

th {
  background-color: #f2f2f2;
}
</style>
