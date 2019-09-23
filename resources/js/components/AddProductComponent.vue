<template>
  <div class="card">
    <div class="card-header">Agregar Producto al Inventario</div>
    <div class="card-body">
      <form action="" v-on:submit.prevent="newProduct()">
        <div class="form-group">
          <label for="nombreProducto">Nombre del producto *</label>
          <input type="text" class="form-control" name="nombreProducto" id="nombreProducto" required v-model="nombreProducto">
        </div>
        <div class="form-row">
        <div class="form-group col-md-4">
            <label for="sku">Referencia *</label>
            <input type="text" class="form-control" name="sku" id="sku" required v-model="sku">
          </div>
          <div class="form-group col-md-4">
            <label for="precio">Precio *</label>
            <input type="number" class="form-control" name="precio" id="precio" min="0" required v-model="precio">
          </div>
          <div class="form-group col-md-4">
            <label for="stock">Cantidad disponible *</label>
            <input type="number" class="form-control" name="stock" id="stock" min="0" required v-model="stock">
          </div>
        </div>
        <button type="submit" class="btn btn-success">Crear Producto</button>
      </form>
    </div>
  </div>
</template>
<script>
  export default {
    data() {
      return{
        id: 0,
        nombreProducto: "",
        sku: "",
        precio: 0,
        stock: 0,
        total: 0
      };
    },
    mounted() {
      console.log('Component Creado.')
    },
    methods: {
      newProduct() {
        const params = {
          nombreProducto: this.nombreProducto,
          sku: this.sku,
          precio: this.precio,
          stock: this.stock
        };
        axios.post('/products', params).then((response) => {
          const product = response.data;
          this.$emit('new', product);
        });
        this.resetForm();
      },
      resetForm() {
        this.id = 0;
        this.nombreProducto = "";
        this.sku = "";
        this.precio = 0;
        this.stock = 0;
      }
    }
  }
</script>