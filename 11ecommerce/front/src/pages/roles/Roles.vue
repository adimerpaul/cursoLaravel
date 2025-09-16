<template>
    <h2>Roles</h2>
    <button style="margin-bottom: 10px;background-color: green;color: white;border: none;padding: 10px;cursor: pointer;"
    @click="createRoles">Crear Rol</button>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="rol in roles" :key="rol.id">
                <td>{{ rol.id }}</td>
                <td>{{ rol.nombre }}</td>
                <td>{{ rol.descripcion }}</td>
                <td>
                    <button @click="ver(rol.id)">Ver</button>
                    <button @click="eliminar(rol.id)">Eliminar</button>
                </td>
            </tr>
        </tbody>
    </table>
</template>
<script>
import axios from 'axios';
export default {
    name: 'Roles',
    data() {
        return {
            roles: []
        };
    },
    mounted() {
        this.rolesGet();
    },
    methods: {
        createRoles() {
            this.$router.push('/roles/crear');
        },
        rolesGet() {
            axios.get('http://143.198.70.37:8000/api/roles')
                .then(response => {
                    // console.log('Roles:', response.data);
                    this.roles = response.data;
                })
                .catch(error => {
                    console.error('Error fetching roles:', error);
                });
        },
        eliminar(id) {
            axios.delete(`http://143.198.70.37:8000/api/roles/${id}`)
                .then(response => {
                    console.log('Rol eliminado:', response.data);
                    this.rolesGet(); // Refresh the list
                })
                .catch(error => {
                    console.error('Error eliminando rol:', error);
                });
        },
        ver(id) {
            this.$router.push(`/roles/${id}`);
        },
    }
};
</script>