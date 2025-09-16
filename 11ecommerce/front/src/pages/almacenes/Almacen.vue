<template>
    <h1>Almacenes</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Código</th>
        <th>Descripción</th>
        <th>Sucursal ID</th>
    </tr>
    <tr v-for="almacen in almacenes" :key="almacen.id">
        <td>{{ almacen.id }}</td>
        <td>{{ almacen.nombre }}</td>
        <td>{{ almacen.codigo }}</td>
        <td>{{ almacen.descripcion }}</td>
        <td>{{ almacen.sucursal_id }}</td>
    </tr>
</table>
<hr>
<label>Agregar almacen:</label>
<input v-model="almacen.nombre" placeholder="Nombre" />
<input v-model="almacen.codigo" placeholder="Código" />
<input v-model="almacen.descripcion" placeholder="Descripción" />
<select v-model="almacen.sucursal_id">
    <option v-for="sucursal in sucursales" :key="sucursal.id" :value="sucursal.id">
        {{ sucursal.nombre }}
    </option>
</select>
<button @click="agregarSucursal">Agregar Sucursal</button>
</template>
<script>
import axios from 'axios';
export default {
    name: "Almacen",
    data() {
        return {
            almacenes: [],
            sucursales: [],
            almacen: {
                nombre: '',
                codigo: '',
                descripcion: '',
                sucursal_id: null
            }
        };
    },
    mounted() {
        this.fetchAlmacenes();
        this.fetchSucursales();
    },
    methods: {
        agregarSucursal() {
            axios.post('http://143.198.70.37:8000/api/almacenes', this.almacen)
                .then(response => {
                    this.fetchAlmacenes(); // Refresh the list after adding
                })
                .catch(error => {
                    alert(error.response.data.message || "Error adding almacen");
                });
        },
        async fetchSucursales() {
            try {
                const response = await axios.get('http://143.198.70.37:8000/api/sucursales');
                this.sucursales = response.data;
            } catch (error) {
                console.error("Error fetching sucursales:", error);
            }
        },
        async fetchAlmacenes() {
            try {
                const response = await axios.get('http://143.198.70.37:8000/api/almacenes');
                this.almacenes = response.data;
            } catch (error) {
                console.error("Error fetching almacenes:", error);
            }
        }
    }
};
</script>