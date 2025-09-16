<template>
    <!-- {{ route id }} -->
    <h2>Detalle del Rol</h2>
    <!-- {{ $route.params.id }} -->
    <div v-if="role">
        <p><strong>ID:</strong> {{ role.id }}</p>
        <p><strong>Nombre:</strong> {{ role.nombre }}</p>
        <p><strong>Descripción:</strong> {{ role.descripcion }}</p>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    name: "RolesView",
    data() {
        return {
            role: null
        };
    },
    mounted() {
        this.fetchRoleData();
    },
    methods: {
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