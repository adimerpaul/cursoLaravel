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
            <input type="file" id="imagen" @change="handleFileUpload" required>
        </div>
        <div>
            <label for="activo">Activo:</label>
            <input type="checkbox" id="activo" v-model="producto.activo">
        </div>
        <!-- <div>
            <label for="categoria_id">Categoría:</label>
            <select id="categoria_id" v-model="producto.categoria_id" required>
                <option disabled value="">Seleccione una categoría</option>
                <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">
                    {{ categoria.nombre }}
                </option>
            </select>
        </div> -->
        <button type="submit">Crear Producto</button>
    </form>
</template>
<script>
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
        };
    },
    methods: {
    },
};
</script>