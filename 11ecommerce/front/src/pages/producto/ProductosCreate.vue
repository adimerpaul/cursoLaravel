<template>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
        <span style="font-size: 1.5rem;font-weight: bold;">Crear Productos</span>
    </div>
    <p>Formulario para crear un nuevo producto:</p>
    <form @submit.prevent="crearProducto">
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
            <input type="file" id="imagen" @change="handleFileUpload" required accept="image/*">
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
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <!-- Crear Categoria -->
        <h2>Crear Categoria</h2>
        <form @submit.prevent="crearCategoria">
            <div>
                <label for="nombre`">Nombre de la Categoría:</label>
                <input type="text" id="nombre`" v-model="categoria.nombre" required>
            </div>
            <div>
                <label for="descripcion`">Descripción de la Categoría:</label>
                <textarea id="descripcion`" v-model="categoria.descripcion" required></textarea>
            </div>
            <button type="submit">Crear Categoría</button>
        </form>
    </form>
</template>
<script>
import axios from 'axios';
export default {
    name: 'ProductosCreate',
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
            categoria: {
                nombre: '',
                descripcion: '',
            },
        };
    },
    mounted() {
        this.categoriasGet();
    },
    methods: {
        crearCategoria() {
            axios.post('http://143.198.70.37:8000/api/categorias', this.categoria)
                .then((response) => {
                    console.log('Categoría creada:', response.data);
                    this.categoria.nombre = '';
                    this.categoria.descripcion = '';
                    this.categoriasGet(); // Refrescar la lista de categorías
                })
                .catch((error) => {
                    console.error('Error creando categoría:', error);
                });
        },
        handleFileUpload(event) {
            const file = event.target.files[0];
            this.producto.imagen = file;
        },
        async categoriasGet() {
            axios.get('http://143.198.70.37:8000/api/categorias')
                .then((response) => {
                    this.categorias = response.data;
                })
                .catch((error) => {
                    console.error('Error fetching categories:', error);
                });
        },
        crearProducto() {
            const formData = new FormData();
            for (const key in this.producto) {
                formData.append(key, this.producto[key]);
            }
            formData.append('imagen', this.producto.imagen);
            axios.post('http://143.198.70.37:8000/api/productos', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            })
                .then((response) => {
                    console.log('Producto creado:', response.data);
                    // Resetear el formulario
                    this.$router.push('/productos');
                })
                .catch((error) => {
                    console.error('Error creando producto:', error);
                });
        },
    },
};
</script>