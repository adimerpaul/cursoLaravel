<template>
    <form @submit.prevent="rolCreate">
        <h2>Crear Rol</h2>
        <div>
            <label for="name">Nombre:</label>
            <input type="text" id="name" v-model="name" required />
        </div>
        <div>
            <label for="resource">Fuente:</label>
            <input type="text" id="resource" v-model="resource" required />
        </div>
        <div>
            <label for="action">Accion:</label>
            <input type="text" id="action" v-model="action" required />
        </div>
        <div>
            <label for="detail">Detalle:</label>
            <input type="text" id="detail" v-model="detail" required />
        </div>
        <button type="submit" style="background-color: green;color: white;border: none;padding: 10px;cursor: pointer;">Guardar</button>
    </form>
</template>
<script>
import axios from 'axios';
export default {
    name: 'RolesCreate',
    data() {
        return {
            name: '',
            resource: '',
            action: '',
            detail: ''
        };
    },
    methods: {
        rolCreate() {
            const newRol = {
                name: this.name,
                resource: this.resource,
                action: this.action,
                detail: this.detail
            };
            axios.post('http://143.198.70.37:8000/api/permisos', newRol)
                .then(response => {
                    console.log('Permiso creado:', response.data);
                    this.$router.push('/permisos');
                })
                .catch(error => {
                    console.error('Error creando permiso:', error);
                });
        }
    }
};
</script>