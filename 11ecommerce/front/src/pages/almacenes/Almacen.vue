<template>
    <h1>Almacenes</h1>
    <!-- [
    {
        "id": 1,
        "nombre": "Almacen 1",
        "codigo": "ALM001",
        "descripcion": "Descripci\u00f3n del Almacen 1",
        "sucursal_id": 1,
        "created_at": "2025-09-12T00:34:46.000000Z",
        "updated_at": "2025-09-12T00:34:46.000000Z"
    },
    {
        "id": 2,
        "nombre": "Almacen 2",
        "codigo": "ALM002",
        "descripcion": "Descripci\u00f3n del Almacen 2",
        "sucursal_id": 2,
        "created_at": "2025-09-12T00:34:46.000000Z",
        "updated_at": "2025-09-12T00:34:46.000000Z"
    }
] -->
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
</template>
<script>
import axios from 'axios';
export default {
    name: "Almacen",
    data() {
        return {
            almacenes: []
        };
    },
    mounted() {
        this.fetchAlmacenes();
    },
    methods: {
        async fetchAlmacenes() {
            try {
                const response = await axios.get('http://localhost:8000/api/almacenes');
                this.almacenes = response.data;
            } catch (error) {
                console.error("Error fetching almacenes:", error);
            }
        }
    }
};
</script>