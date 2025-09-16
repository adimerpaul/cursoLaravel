<template>
    <h1>Datos del Usuario</h1>
    <p>
        Aquí se mostrarán los detalles del usuario seleccionado.
        {{ $route.params.id }}
    </p>
    <!-- <pre>{{ user }} name email </pre> -->
    <div v-if="user">
        <p><strong>Nombre:</strong> {{ user.name }}</p>
        <p><strong>Email:</strong> {{ user.email }}</p>
        <!-- Agrega más campos según la estructura de tu objeto user -->
    </div>
</template>
<script>
import axios from 'axios';
export default {
    name: "UserShow",
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
            axios.get(`http://143.198.70.37:8000/api/users/${this.$route.params.id}`)
                .then(response => {
                    this.user = response.data;
                    // console.log(this.user);
                })
                .catch(error => {
                    console.error("Error fetching user data:", error);
                });
        }
    }
};
</script>