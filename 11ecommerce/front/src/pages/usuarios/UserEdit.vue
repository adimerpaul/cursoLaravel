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
        <ul>
            <li v-for="role in user.roles" :key="role.id">
                    {{ role.nombre }}
            </li>
        </ul>
        <button type="submit">Guardar Cambios</button>
        <!-- <pre>{{ roles }}</pre> -->
         <hr>
        <h2>Asignar Roles</h2>
        <select v-model="role">
            <option v-for="role in roles" :key="role.id" :value="role.id">
                {{ role.nombre }}
            </option>
        </select>
        <button type="button" @click="agregarRol">Agregar Rol</button>
    </form>
</template>
<script>
import axios from 'axios';
export default {
    name: "UserEdit",
    data() {
        return {
            user: null,
            roles: [],
            role: null
        };
    },
    mounted() {
        this.fetchUserData();
        this.fetchRoles();
        this.fetchRolesUser();
    },
    methods: {
        agregarRol() {
            if (this.role) {
                axios.post(`http://143.198.70.37:8000/api/users/${this.$route.params.id}/roles`, { role_id: this.role })
                    .then(response => {
                        alert("Rol asignado con éxito");
                        this.fetchRolesUser(); // Refrescar los roles del usuario
                    })
                    .catch(error => {
                        console.error("Error assigning role:", error);
                    });
            } else {
                alert("Por favor, selecciona un rol.");
            }
        },
        fetchRolesUser() {
            axios.get(`http://143.198.70.37:8000/api/users/${this.$route.params.id}/roles`)
                .then(response => {
                    this.user.roles = response.data;
                    // console.log(this.user.roles);
                })
                .catch(error => {
                    console.error("Error fetching user roles:", error);
                });
        },
        fetchRoles() {
            axios.get('http://143.198.70.37:8000/api/roles')
                .then(response => {
                    this.roles = response.data;
                })
                .catch(error => {
                    console.error("Error fetching roles:", error);
                });
        },
        async fetchUserData() {
            axios.get(`http://143.198.70.37:8000/api/users/${this.$route.params.id}`)
                .then(response => {
                    this.user = response.data;
                    // console.log(this.user);
                })
                .catch(error => {
                    console.error("Error fetching user data:", error);
                });
        },
        actualizarUsuario() {
            axios.put(`http://143.198.70.37:8000/api/users/${this.$route.params.id}`, this.user)
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