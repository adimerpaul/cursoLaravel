<template>
    <form @submit.prevent="rolCreate">
        <h2>Crear Rol</h2>
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" v-model="nombre" required />
        </div>
        <div>
            <label for="descripcion">Descripción:</label>
            <input type="text" id="descripcion" v-model="descripcion" required />
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
            nombre: '',
            descripcion: ''
        };
    },
    methods: {
        rolCreate() {
            const newRol = {
                nombre: this.nombre,
                descripcion: this.descripcion
            };
            axios.post('http://localhost:8000/api/roles', newRol)
                .then(response => {
                    console.log('Rol creado:', response.data);
                    this.$router.push('/roles');
                })
                .catch(error => {
                    console.error('Error creando rol:', error);
                });
        }
    }
};
</script>