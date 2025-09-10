<template>
    <h1>Datos del Usuario</h1>
    <p>
        Aquí se mostrarán los detalles del usuario seleccionado.
        {{ $route.params.id }}
    </p>
    <!-- <pre>{{ user }} name email </pre> -->
    <form v-if="user" @submit.prevent="actualizarUsuario">
        <div>
            <label for="name"><strong>Nombre:</strong></label>
            <input type="text" id="name" v-model="user.name" />
        </div>
        <div>
            <label for="email"><strong>Email:</strong></label>
            <input type="email" id="email" v-model="user.email" />
        </div>
        
        <div>
            <label for="password"><strong>Contraseña:</strong></label>
            <input type="password" id="password" v-model="user.password" placeholder="Dejar en blanco para no cambiar" />
        </div>
        <!-- Agrega más campos según la estructura de tu objeto user -->
        <button type="submit">Guardar Cambios</button>
    </form>
</template>
<script>
import axios from 'axios';
export default {
    name: "UserEdit",
    data() {
        return {
            user: null
        };
    },
    mounted() {
        this.fetchUserData();
    },
    methods: {
        async fetchUserData() {
            axios.get(`http://localhost:8000/api/users/${this.$route.params.id}`)
                .then(response => {
                    this.user = response.data;
                    // console.log(this.user);
                })
                .catch(error => {
                    console.error("Error fetching user data:", error);
                });
        },
        actualizarUsuario() {
            axios.put(`http://localhost:8000/api/users/${this.$route.params.id}`, this.user)
                .then(response => {
                    alert("Usuario actualizado con éxito");
                    this.$router.push('/usuarios');
                })
                .catch(error => {
                    console.error("Error updating user data:", error);
                });
        }
    }
};
</script>