<template>
    <h2>Crear Usuario</h2>
    <form @submit.prevent="createUser">
        <div>
            <label for="name">Nombre:</label>
            <input type="text" id="name" v-model="user.name">
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" v-model="user.email">
        </div>
        <div>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" v-model="user.password">
        </div>
        <button type="submit">Crear</button>
    </form>
</template>
<script>
import axios from 'axios';
export default {
    name: "UserCreate",
    data() {
        return {
            user: {
                name: '',
                email: '',
                password: ''
            }
        };
    },
    methods: {
        async createUser() {
            axios.post('http://localhost:8000/api/users', this.user)
                .then(response => {
                    console.log("User created successfully:", response.data);
                    this.$router.push('/usuarios');
                })
                .catch(error => {
                    console.error("There was an error creating the user!", error);
                });
        }
    }
};
</script>