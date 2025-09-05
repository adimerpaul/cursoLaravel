<template>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
        <span style="font-size: 1.5rem;font-weight: bold;">Crear Productos</span>
    </div>
    <p>Formulario para crear un nuevo producto:</p>
    <form @submit.prevent="productoEditar">
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" v-model="producto.nombre" required>
        </div>
        <div>
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" v-model="producto.descripcion" required></textarea>
        </div>
        <div>
            <label for="codigo_barra">Código de Barra:</label>
            <input type="text" id="codigo_barra" v-model="producto.codigo_barra" required>
        </div>
        <div>
            <label for="unidad_medida">Unidad de Medida:</label>
            <input type="text" id="unidad_medida" v-model="producto.unidad_medida" required>
        </div>
        <div>
            <label for="marca">Marca:</label>
            <input type="text" id="marca" v-model="producto.marca" required>
        </div>
        <div>
            <label for="precio_venta_actual">Precio de Venta Actual:</label>
            <input type="number" id="precio_venta_actual" v-model="producto.precio_venta_actual" required>
        </div>
        <div>
            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" @change="handleFileUpload" accept="image/*">
        </div>
        <!-- <div>
            <label for="activo">Activo:</label>
            <input type="checkbox" id="activo" v-model="producto.activo">
        </div> -->
        <div>
            <label for="categoria_id">Categoría:</label>
            <select id="categoria_id" v-model="producto.categoria_id" required>
                <option disabled value="">Seleccione una categoría</option>
                <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">
                    {{ categoria.nombre }}
                </option>
            </select>
        </div>
        <button type="submit">Crear Producto</button>
        <!-- <pre>
            {{ categorias }}
        </pre> -->
    </form>
</template>
<script>
import axios from 'axios';
export default {
    name: 'ProductosEditar',
    data() {
        return {
            producto: {
                nombre: '',
                descripcion: '',
                codigo_barra: '',
                unidad_medida: '',
                marca: '',
                precio_venta_actual: 0,
                imagen: '',
                activo: true,
                categoria_id: null,
            },
            categorias: [],
        };
    },
    mounted() {
        this.categoriasGet();
        this.productoGet();
    },
    methods: {
        productoGet() {
            axios.get(`http://localhost:8000/api/productos/${this.$route.params.id}`)
                .then((response) => {
                    this.producto = response.data;
                })
                .catch((error) => {
                    console.error('Error fetching product:', error);
                });
        },
        
        handleFileUpload(event) {
            const file = event.target.files[0];
            this.producto.imagen = file;
        },
        async categoriasGet() {
            axios.get('http://localhost:8000/api/categorias')
                .then((response) => {
                    this.categorias = response.data;
                })
                .catch((error) => {
                    console.error('Error fetching categories:', error);
                });
        },
        productoEditar() {
            const formData = new FormData();
            formData.append('nombre', this.producto.nombre);
            formData.append('descripcion', this.producto.descripcion);
            formData.append('codigo_barra', this.producto.codigo_barra);
            formData.append('unidad_medida', this.producto.unidad_medida);
            formData.append('marca', this.producto.marca);
            formData.append('precio_venta_actual', this.producto.precio_venta_actual);
            formData.append('imagen', this.producto.imagen);
            formData.append('activo', this.producto.activo ? 1 : 0);
            formData.append('categoria_id', this.producto.categoria_id);
``
            axios.post(`http://localhost:8000/api/productos/${this.$route.params.id}`, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            })
                .then((response) => {
                    console.log('Producto editado:', response.data);
                    // Resetear el formulario
                    this.producto = {
                        nombre: '',
                        descripcion: '',
                        codigo_barra: '',
                        unidad_medida: '',
                        marca: '',
                        precio_venta_actual: 0,
                        imagen: '',
                        activo: true,
                        categoria_id: null,
                    };
                    // Redirigir a la vista de productos
                    this.$router.push('/productos');
                })
                .catch((error) => {
                    console.error('Error creating product:', error);
                });
        },
    },
};
</script>