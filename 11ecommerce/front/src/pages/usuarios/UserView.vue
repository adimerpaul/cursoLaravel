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
            <th>Opciones</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="user in users" :key="user.id">
            <td>{{ user.id }}</td>
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
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
            users: []
        };
    },
    mounted() {
        this.fetchUsers();
    },
    methods: {
        async fetchUsers() {
            axios.get('http://localhost:8000/api/users').then(response => {
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