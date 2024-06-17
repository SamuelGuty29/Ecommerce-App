<template>
	<div class="card">
		<div class="card-header d-flex justify-content-end">
			<button class="btn btn-success" @click="openModal">Crear usuario</button>
		</div>
		<div class="card-body">
			<div class="table-responsive my-4 mx-2">
				<table class="table table-bordered" id="user_table">
					<thead>
						<tr>
							<th scope="col">Image</th>
							<th scope="col">Cedula</th>
							<th scope="col">Nombre</th>
							<th scope="col">Apellido</th>
							<th scope="col">Email</th>
							<th scope="col">Role</th>
							<th scope="col">Acciones</th>
						</tr>
					</thead>
					<tbody>
							<tr v-for="(user, index) in users" :key="index">
								<th scope="row"> 
									<img :src ="user.file.route" alt="avatar de usuario" width="80"  height="80">
								</th>
								<th scope="row">{{ user.number_id }}</th>
								<th scope="row">{{ user.name }}</th>
								<th scope="row">{{ user.last_name }}</th>
								<th scope="row">{{ user.email }}</th>
								<th scope="row">
									<span v-for="(role, roleIndex) in user.roles" :key="roleIndex">
										{{ role.name }}
									</span>
								</th>
								<th scope="row">
									<div class="d-flex justify-content-center">
										<button type="button" class="btn btn-warning btn-sm" @click="editUser(user)">
											<i class="fa-solid fa-pen"></i></button>

											<button type="button" class="btn btn-danger btn-sm ms-2" title="Eliminar" @click="deleteUser(user)" ><i class="fa-solid fa-trash"></i></button>
									</div>
									
								</th>
							</tr>
						</tbody>
						</table>
							</div>
		</div>
		<user-modal ref="user_modal" :roles_data="roles_data" :user_data = "user"/>
	</div>
		
	
</template>
<script>
import UserModal from './UserModal.vue';
import { deleteMessage  } from '@/helpers/Alert.js'

export default {
	components: {
		UserModal
	},
	props: ['users', 'roles_data'],
	data() {
		return {
			modal: null,
			user: {}
		}
	},
	mounted() {
		this.index()
	},
	methods: {
		async index() {
			$('#user_table').DataTable()
			const modal_id = document.getElementById('user_modal')
			this.modal = new bootstrap.Modal(modal_id)
			modal_id.addEventListener('hidden.bs.modal', e => {
				 this.$refs.user_modal.reset()				
			})
		},
		editUser(user) {
            this.user = user
            this.openModal()
		},
		async deleteUser({ id }) {
            if(!await deleteMessage()) return
            try {
                await axios.delete(`/users/${id}`)
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