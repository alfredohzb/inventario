<template>
	<tr>
		<th scope="row">{{ product.sku }}</th>
		<td>{{ product.nombreProducto }}</td>
		<td v-if="editMode">
			<input type="number" class="form-control" name="stock" id="stock" min="0" v-model="product.stock" >
		</td>
		<td v-else>{{ product.stock}}</td>
		<td v-if="editMode">
			<input type="number" class="form-control" name="precio" id="precio" min="0" v-model="product.precio">
		</td>
		<td v-else>{{ product.precio }}</td>
		<td>{{product.total}}</td>
		<td>
			<div v-if="editMode">
				<button class="btn btn-success" v-on:click="updateProduct(product.id)">Guardar</button>
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
				editMode: false
			};
		},
		mounted() {
			console.log('Component mounted.')
		},
		methods: {
			editProduct() {
				this.editMode = true;
			},
			cancelEdit() {
				this.editMode = false;
			},
			updateProduct() {
				this.cancelEdit();
				this.product.total = this.product.stock * this.product.precio;
				this.$emit('update', product);
			}
		}
	}
</script>
