<template>
  <div class="row justify-content-center">
		<div class="col-md-11">
			<add-product-component @new="addProduct"></add-product-component>
		</div>
		<div class="col-md-11">
			<div class="card">
				<div class="card-header">Listado de los productos</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr align="center">
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
            <tfoot>
              <tr>
                <td>Mostrando {{actualMax}} de {{cantidadTotal}}</td>
                <td></td>
                <td>Cantidad Total: {{cantidadTotalItems}}</td>
                <td></td>
                <td>Total Precios: {{totalPrecios}}</td>
              </tr>
              <tr>
                <b-pagination
                    :total-rows="pagination.total"
                    v-model="postsData.page"
                    :per-page="postsData.per_page"
                    size="sm"
                    align="right"
                    @change="pageChangeExact"
                  />
              </tr>
            </tfoot>
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
        products: [],
        cantidadTotal: 0,
        actualMax: 0,
        totalPrecios: 0,
        cantidadTotalItems: 0,
        postsData: {
          per_page: 5,
          page: 1,
        },
        pagination: {
          total: 2
        }
      }
    },
    mounted() {
      axios.get('/products?per_page='+this.postsData.per_page).then((response) => {
        this.cantidadTotal = response.data.total;
        this.pagination.total = response.data.total;
        this.actualMax  = response.data.to;
        this.products = response.data.data;
        this.calculateTotal(this.products);
      });
    },
    methods: {
      addProduct(product){
        this.products.push(product);
        let _this = this;
        axios.get('/products').then((response) => {
          this.cantidadTotal = response.data.total;
          this.actualMax  = response.data.to;
          this.calculateTotal();
        });
      },
      updateProduct(index, product) {
        this.products[index] = product;
        this.calculateTotal();
      },
      calculateTotal(products) {
        let result = 0;
        let cantidadTotalItems = 0;
        products.forEach(element => {
          cantidadTotalItems += element.stock;
          result += (element.stock * element.precio);
        });
        this.cantidadTotalItems = cantidadTotalItems;
        this.totalPrecios = result;
      },
      pageChangeExact(page) {
        axios.get('/products?page='+page+'&per_page='+this.postsData.per_page).then((response) => {
          this.cantidadTotal = response.data.total;
          this.actualMax  = response.data.to;
          this.products = response.data.data;
          this.calculateTotal(this.products);
        });
      },
    }
  }
</script>
