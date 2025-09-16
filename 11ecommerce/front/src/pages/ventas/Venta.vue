<template>
    <h1>Ventas</h1>
    <p>Aquí puedes gestionar las ventas.</p>
    <table>
        <tr>
            <td>
                Productos Disponibles
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Imagen</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="producto in productos" :key="producto.id">
                            <td>{{ producto.nombre }}</td>
                            <td>{{ producto.precio_venta_actual }}</td>
                            <td>
                                <img :src="`http://localhost:8000/imagenes/${producto.imagen}`" alt="Imagen del producto" style="max-width: 45px; max-height: 45px;" v-if="producto.imagen"/>
                            </td>
                            <td>
                                <button @click="agregarAlCarrito(producto)">Agregar al Carrito</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td>
                Carrito de Compras
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in carrito" :key="index">
                            <td>{{ item.nombre }}</td>
                            <td>{{ item.precio_venta_actual }}</td>
                            <td>
                                <input type="number" v-model.number="item.cantidad" min="1" style="width: 50px;"/>
                            </td>
                            <td>
                                <button @click="eliminarDelCarrito(index)">Eliminar</button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" style="text-align: right; font-weight: bold;">
                                Total: {{ carrito.reduce((total, item) => total + (item.precio_venta_actual * item.cantidad), 0) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <label for="cliente">Seleccionar Cliente:</label>
                <select v-model="selectedCliente" id="cliente" style="margin-top: 0.5rem; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px; width: 100%;">
                    <option v-for="cliente in clientes" :key="cliente.id" :value="cliente.id">
                        {{ cliente.razon_social }}
                    </option>
                </select>
                <button @click="realizarVenta" style="margin-top: 1rem; padding: 0.5rem 1rem; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">
                    Realizar Venta
                </button>
            </td>
        </tr>
    </table>
    <pre>
        <!-- <code>{{ clientes }}</code> -->
        <!-- <code>{{ carrito }}</code> -->
    </pre>
</template>
<script>
import axios from 'axios';
export default {
    name: 'VentaPage',
    data() {
        return {
            productos: [],
            carrito: [],
            clientes: [],
            selectedCliente: null,
        };
    },
    mounted() {
        this.fetchProductos();
        this.fetchClientes();
    },
    methods: {
        fetchClientes() {
            const token = localStorage.getItem('token');
            axios.get('http://localhost:8000/api/clientes', {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            })
            .then(response => {
                this.clientes = response.data;
            })
            .catch(error => {
                console.error('Error al cargar clientes:', error);
            });
        },
        fetchProductos() {
            const token = localStorage.getItem('token');
            axios.get('http://localhost:8000/api/productos?limit=100'+'&page=1&search=', {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            })
            .then(response => {
                this.productos = response.data.data;
            })
            .catch(error => {
                console.error('Error al cargar productos:', error);
            });
        },
        agregarAlCarrito(producto) {
            let productoNew = { ...producto };
            productoNew.cantidad = 1;
            this.carrito.push(productoNew);
        },
        eliminarDelCarrito(index) {
            this.carrito.splice(index, 1);
        },
        realizarVenta() {
            if (this.carrito.length === 0) {
                alert('El carrito está vacío.');
                return;
            }
            if (!this.selectedCliente) {
                alert('Por favor, selecciona un cliente.');
                return;
            }
            const token = localStorage.getItem('token');
            const ventaData = {
                items: this.carrito.map(item => ({
                    producto_id: item.id,
                    cantidad: item.cantidad,
                    precio_unitario: item.precio_venta_actual
                })),
                cliente_id: this.selectedCliente
            };
            axios.post('http://localhost:8000/api/ventas', ventaData, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            })
            .then(response => {
                alert('Venta realizada con éxito.');
                this.carrito = [];
                this.selectedCliente = null;
            })
            .catch(error => {
                console.error('Error al realizar la venta:', error);
                alert('Error al realizar la venta.');
            });
        }
    },
};
</script>