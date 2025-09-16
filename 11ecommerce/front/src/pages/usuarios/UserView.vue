<template>
    <h1>Usuarios</h1>
    <button @click="createUser" style="padding: 10px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;">
        Crear Usuario
    </button>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Roles</th>
            <th>Opciones</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="user in users" :key="user.id">
            <td>{{ user.id }}</td>
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>
                <ul>
                    <li v-for="role in user.roles" :key="role.id">{{ role.nombre }}</li>
                </ul>
            </td>
            <td>
                <button @click="editUser(user.id)">Editar</button>
                <button @click="deleteUser(user.id)">Eliminar</button>
                <button @click="viewUser(user.id)">Ver</button>
            </td>
        </tr>
        </tbody>
    </table>
</template>
<script>
import axios from 'axios';
export default {
    name: "UserView",
    data() {
        return {
            users: [],
            permisos: []
        };
    },
    mounted() {
        this.permisos = JSON.parse(localStorage.getItem('permisos')) || [];
        console.log("Permisos cargados desde localStorage:", this.permisos);
        this.fetchUsers();
    },
    methods: {
        deleteUser(id) {
            if (confirm("¿Estás seguro de que deseas eliminar este usuario?")) {
                axios.delete(`http://143.198.70.37:8000/api/users/${id}`)
                    .then(response => {
                        alert("Usuario eliminado con éxito");
                        this.fetchUsers(); // Refrescar la lista de usuarios
                    })
                    .catch(error => {
                        console.error("Error deleting user:", error);
                    });
            }
        },
        editUser(id) {
            this.$router.push('/usuarios/editar/' + id);
        },
        async fetchUsers() {
            if (!this.permisos.includes('view_user')) {
                alert("No tienes permiso para ver los usuarios.");
                return;
            }
            const token = localStorage.getItem('token');
            axios.get('http://143.198.70.37:8000/api/users', {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            }).then(response => {
                this.users = response.data;
            }).catch(error => {
                console.error("There was an error fetching the users!", error);
            });
        },
        viewUser(id) {
            this.$router.push('/usuarios/' + id);
        },
        createUser() {
            this.$router.push('/usuarios/crear');
        },
    }
};
</script>