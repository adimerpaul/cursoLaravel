<template>
    <h2>permisos</h2>
    <button style="margin-bottom: 10px;background-color: green;color: white;border: none;padding: 10px;cursor: pointer;"
    @click="createpermisos">Crear permiso</button>
    <table border="1">
        <thead>
            <tr>
                    <!-- {
        "id": 1,
        "name": "create_user",
        "resource": "user",
        "action": "create",
        "detail": "Create a new user",
        "created_at": null,
        "updated_at": null
    }, -->
                <th>ID</th>
                <th>Nombre</th>
                <th>Fuente</th>
                <th>Accion</th>
                <th>Detalle</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="permiso in permisos" :key="permiso.id">
                <td>{{ permiso.id }}</td>
                <td>{{ permiso.name }}</td>
                <td>{{ permiso.resource }}</td>
                <td>{{ permiso.action }}</td>
                <td>{{ permiso.detail }}</td>
                <td>
                    <!-- <button @click="ver(permiso.id)">Ver</button> -->
                    <button @click="eliminar(permiso.id)">Eliminar</button>
                </td>
            </tr>
        </tbody>
    </table>
</template>
<script>
import axios from 'axios';
export default {
    name: 'Permisos',
    data() {
        return {
            permisos: []
        };
    },
    mounted() {
        this.permisosGet();
    },
    methods: {
        createpermisos() {
            this.$router.push('/permisos/crear');
        },
        permisosGet() {
            axios.get('http://143.198.70.37:8000/api/permisos')
                .then(response => {
                    // console.log('permisos:', response.data);
                    this.permisos = response.data;
                })
                .catch(error => {
                    console.error('Error fetching permisos:', error);
                });
        },
        eliminar(id) {
            axios.delete(`http://143.198.70.37:8000/api/permisos/${id}`)
                .then(response => {
                    console.log('permiso eliminado:', response.data);
                    this.permisosGet(); // Refresh the list
                })
                .catch(error => {
                    console.error('Error eliminando permiso:', error);
                });
        },
        ver(id) {
            this.$router.push(`/permisos/${id}`);
        },
    }
};
</script>