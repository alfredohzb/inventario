<template>
	<tr align="center">
		<th scope="row">{{ product.sku }}</th>
		<td>{{ product.nombreProducto }}</td>
		<td align="center" v-if="editMode">
			<input type="number" class="form-control" name="stock" id="stock" min="0" v-model="product.stock" >
		</td>
		<td align="center" v-else>{{ product.stock}}</td>
		<td v-if="editMode">
			<input type="number" class="form-control" name="precio" id="precio" min="0" v-model="product.precio">
		</td>
		<td v-else>{{ product.precio }}</td>
		<td align="center" class="total">{{valorTotal}}</td>
		<td>
			<div v-if="editMode">
				<button class="btn btn-success" v-on:click="updateProduct()">Guardar</button>
				<button class="btn btn-danger" v-on:click="cancelEdit()">Cancelar</button>
			</div>
			<button v-else class="btn btn-warning" v-on:click="editProduct()">Editar</button>
		</td>
	</tr>
</template>

<script>
	export default {
		props: ['product'],
		data(){
			return{
				editMode: false,
				valorTotal: 0
			};
		},
		mounted() {
			this.valorTotal = this.product.stock * this.product.precio;
		},
		methods: {
			editProduct() {
				this.editMode = true;
			},
			cancelEdit() {
				this.editMode = false;
			},
			updateProduct() {
				const params = {
					nombreProducto: this.product.nombreProducto,
          sku: this.product.sku,
          precio: this.product.precio,
          stock: this.product.stock
				}
				axios.put(`/products/${this.product.id}`, params).then((response) => {
					this.cancelEdit();
					const product = response.data;
					this.$emit('update', product);
					this.valorTotal = this.product.stock * this.product.precio;
				})
			}
		}
	}
</script>
