<template>
  <div class="row justify-content-center">
		<div class="col-md-10">
			<add-product-component @new="addProduct"></add-product-component>
		</div>
		<div class="col-md-10">
			<div class="card">
				<div class="card-header">Listado de los productos</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Referencia</th>
								<th scope="col">Nombre</th>
								<th scope="col">Cantidad</th>
								<th scope="col">Precio</th>
								<th scope="col">Precio Total</th>
								<th scope="col">Acciones</th>
							</tr>
						</thead>
						<tbody>
							<product-component
                v-for="(product, index) in products"
                :key="product.id"
                :product="product"
                @update="updateProduct(index, product)"
              ></product-component>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
  export default {
    data() {
      return {
        products: [{
          'id': 1,
          'nombreProducto': "Ejemplo",
          'sku': "2aq1",
          'precio': "5000",
          'stock': "20",
          'total': "100000"
        }]
      }
    },
    mounted() {
      console.log('Component mounted.')
    },
    methods: {
      addProduct(product){
        this.products.push(product);
      },
      updateProduct(index, product) {
        this.products[index] = product;
      }
    }
  }
</script>
