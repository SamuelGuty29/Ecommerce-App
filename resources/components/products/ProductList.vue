<template>
	<div class="card">
		<div class="card-header d-flex justify-content-end">
			<button class="btn btn-success" @click="openModal">Crear Producto</button>
		</div>
		<div class="card-body">
			<div class="table-responsive my-4 mx-2">
				<table class="table table-bordered" id="product_table">
					<thead>
						<tr>
							<th scope="col">Image</th>
							<th scope="col">Nombre</th>
							<th scope="col">Descripción</th>
							<th scope="col">Precio</th>
							<th scope="col">Stock</th>
							<th scope="col">Categoria</th>
							<th scope="col">Acciones</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(product, index) in products" :key="index">

								<th scope="row">
									<img :src ="product.file.route" alt="imagen del producto" width="80">
                                </th>
								<th scope="row">{{ product.name }}</th>
								<th scope="row">{{ product.description }}</th>
								<th scope="row">{{ product.price }}</th>
								<th scope="row">{{ product.stock }}</th>
								<th scope="row">{{ product.category_id }}</th>

								<th scope="row">
									<td>
										<div class="d-flex justify-content-center" title="Editar">
		
											<button type="button" class="btn btn-warning btn-sm" @click="edit(product)">
												<i class="fa-solid fa-pen"></i></button>
											<button type="button" class="btn btn-danger btn-sm ms-2" @click="deleteP(product)" title="Eliminar" ><i class="fa-solid fa-trash"></i></button>
										</div>
		
									</td>
								</th>
							</tr>
						</tbody>
					</table>
			</div>
		</div>
		<product-modal ref="product_modal" :category_data = "category_data" :product_data = "product"/>
	</div>
		
	
</template>

<script>
import { successMessage, handlerErrors } from '@/helpers/Alert.js'
import ProductModal from './ProductModal.vue';
import { deleteMessage  } from '@/helpers/Alert.js'


export default {
	components: {
		ProductModal
	},
	props: ['products', 'category_data'],
	data() {
		return {
			modal: null,
			product: {}
		}
	},
	mounted() {
		this.index()
	},
	methods: {
		async index() {
			$('#product_table').DataTable()
			const modal_id = document.getElementById('product_modal')
			this.modal = new bootstrap.Modal(modal_id)
			modal_id.addEventListener('hidden.bs.modal', e => {
				 this.$refs.product_modal.reset()				
			})
		},
		edit(product) {
            this.product = product
            this.openModal()
		},
		async deleteP({ id }) {
            if(!await deleteMessage()) return
            try {
                await axios.delete(`/products/${id}`)
                window.location.reload()
                await successMessage({is_delete: true, reload: true})
            } catch (error) {
                console.error(error);
            }
        },
		openModal() {
			this.modal.show()
		},
	}
}
</script>