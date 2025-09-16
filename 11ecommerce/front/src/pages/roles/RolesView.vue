<template>
    <!-- {{ route id }} -->
    <h2>Detalle del Rol</h2>
    <!-- {{ $route.params.id }} -->
    <div v-if="role">
        <p><strong>ID:</strong> {{ role.id }}</p>
        <p><strong>Nombre:</strong> {{ role.nombre }}</p>
        <p><strong>Descripción:</strong> {{ role.descripcion }}</p>
    </div>
    <ul>
        <li v-for="permiso in role?.permisos" :key="permiso.id">
            {{ permiso.name }} - {{ permiso.detail }}
        </li>
    </ul>
    <hr>
    <h3>Todos los Permisos</h3>
    <select v-model="rolePermisoAdd">
        <option v-for="permiso in permisos" :key="permiso.id" :value="permiso.id">
            {{ permiso.name }} - {{ permiso.detail }}
        </option>
    </select>
    <button @click="addPermisoToRole">Añadir Permiso al Rol</button>
</template>
<script>
import axios from 'axios';
export default {
    name: "RolesView",
    data() {
        return {
            role: null,
            permisos: [],
            rolePermisoAdd: null
        };
    },
    mounted() {
        this.fetchRoleData();
        this.fetchRolePermisos();
        this.fetchPermisos();
    },
    methods: {
        addPermisoToRole() {
            if (!this.rolePermisoAdd) {
                alert("Seleccione un permiso para añadir.");
                return;
            }
            axios.post(`http://143.198.70.37:8000/api/roles/${this.$route.params.id}/permisos`, {
                permiso_id: this.rolePermisoAdd
            })
                .then(response => {
                    alert("Permiso añadido al rol exitosamente.");
                    this.fetchRolePermisos(); // Refrescar la lista de permisos del rol
                })
                .catch(error => {
                    console.error("Error adding permiso to role:", error);
                    alert("Error al añadir el permiso al rol.");
                });
        },
        async fetchPermisos() {
            axios.get('http://143.198.70.37:8000/api/permisos')
                .then(response => {
                    this.permisos = response.data;
                })
                .catch(error => {
                    console.error("Error fetching permisos:", error);
                });
        },
        async fetchRolePermisos() {
            axios.get(`http://143.198.70.37:8000/api/roles/${this.$route.params.id}/permisos`)
                .then(response => {
                    this.role.permisos = response.data;
                })
                .catch(error => {
                    console.error("Error fetching role permisos:", error);
                });
        },
        async fetchRoleData() {
            axios.get(`http://143.198.70.37:8000/api/roles/${this.$route.params.id}`)
                .then(response => {
                    this.role = response.data;
                    // console.log(this.role);
                })
                .catch(error => {
                    console.error("Error fetching role data:", error);
                });
        }
    }
};
</script>