<template>
	<div class="modal fade" id="user_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
		aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">{{ is_create ? 'Crear' : 'Editar' }} Usuario</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>

				<Form ref="Form" @submit="Guardar" :validation-schema="schema">
					<div class="modal-body">
				<section class="row">
					<div class="mb-3 col-12">
				
						<div class="col-12 d-flex justify-content-center mt-1">
							<img :src="image_preview" alt="Imagen usuario"  class="img-thumbnail" width="170" height="170">
						</div>

						<div class="col-12 mt-1 ">
							<label for="file" class="form-label">Imagen</label>
							<input type="file" :class="`form-control ${back_errors['file'] ? 'is-invalid' : ''}`"
									id="file" accept="image/*" @change="previewImage">
								<span class="invalid-feedback" v-if="back_errors['file']">
									{{ back_errors['file'] }}
								</span>
						</div>
					</div>
				
					<div class="col-12 mt-2">
						<Field name="role" v-slot="{ errorMessage, field }" v-model="role">
							<label for="role">Rol</label>

							<v-select :options="roles_data" label="name" v-model="role"
								:reduce="role => role.name" v-bind="field" placeholder="Seleccione Rol"
								:clearable="false" :class="`${errorMessage ? 'is-invalid' : ''}`">
							</v-select>

							<span class="invalid-feedback">{{ errorMessage }}</span>
							<span class="invalid-feedback">{{ back_errors['role'] }}</span>
						</Field>
					</div>
				
					<div class="col-12 mt-2">
						<label for="number_id">Cedula</label>
						<Field name="number_id" v-slot="{ errorMessage, field}" v-model="user.number_id">
							<input type="number" id="title" v-model="user.number_id" :class="`form-control ${errorMessage ? 'is-invalid' : ''}`" v-bind="field">

							<span class="invalid-feedback">{{errorMessage}}</span>
							<span class="invalid-feedback">{{ back_errors['file'] }}</span>

						</Field>
					</div>
				
					<div class="col-12 mt-2">
						<label for="name">Nombre</label>
						<Field name="name" v-slot="{ errorMessage, field}" v-model="user.name">
							<input type="text" id="name" v-model="user.name" :class="`form-control ${errorMessage ? 'is-invalid' : ''}`" v-bind="field">
							<span class="invalid-feedback">{{errorMessage}}</span>
							<span class="invalid-feedback">{{ back_errors['name'] }}</span>

						</Field>
					</div>

					<div class="col-12 mt-2">
						<label for="last_name">Apellido</label>
						<Field name="last_name" v-slot="{ errorMessage, field}" v-model="user.last_name">
							<input type="text" id="last_name" v-model="user.last_name" :class="`form-control ${errorMessage ? 'is-invalid' : ''}`" v-bind="field">
							<span class="invalid-feedback">{{errorMessage}}</span>
							<span class="invalid-feedback">{{ back_errors['last_name'] }}</span>

						</Field>
					</div>
				
					<div class="col-12 mt-2">
						<label for="email">Correo Electronico</label>
						<Field name="email" v-slot="{ errorMessage, field}" v-model="user.email">
							<input type="text" id="email" v-model="user.email" :class="`form-control ${errorMessage ? 'is-invalid' : ''}`" v-bind="field">
							<span class="invalid-feedback">{{errorMessage}}</span>
							<span class="invalid-feedback">{{ back_errors['email'] }}</span>

						</Field>
					</div>

					<div class="col-12 mt-2">
						<label for="password">Contraseña</label>
						<Field name="password" v-slot="{ errorMessage, field}" v-model="user.password">
							<input type="password" id="password" v-model="user.password" :class="`form-control ${errorMessage ? 'is-invalid' : ''}`" v-bind="field">
							<span class="invalid-feedback">{{errorMessage}}</span>
							<span class="invalid-feedback">{{ back_errors['password'] }}</span>

						</Field>
					</div>
					<div class="col-12 mt-2">
						<label for="password_confirmation">Confirmar contraseña</label>
						<Field name="password_confirmation" v-slot="{ errorMessage, field}" v-model="user.password_confirmation">
							<input type="password" id="password_confirmation"  v-model="user.password_confirmation" :class="`form-control ${errorMessage ? 'is-invalid' : ''}`" v-bind="field">
							<span class="invalid-feedback">{{errorMessage}}</span>
							<span class="invalid-feedback">{{ back_errors['password_confirmation'] }}</span>

						</Field>
					</div>
				
					<div class="col-12">
						<button class="btn btn-secondary me-2">Cancelar</button>
						<button type="submit" class="btn btn-primary">Almacenar</button>
					</div>
				</section>
				</div>
				</Form>

				
				
			</div>
		</div>
	</div>
</template>


<script>

import { Field, Form } from 'vee-validate'
import * as yup from 'yup'
import BackendError from '../Components/BackendError.vue'
import { successMessage, handlerErrors } from '@/helpers/Alert.js'

export default {
	props: ['roles_data', 'user_data'],
	components: { Field, Form },
	watch: {
			user_data(new_value) {
			this.user = {...new_value}
            if (!this.user.id)return
			this.is_create = false
			this.role = this.user.roles[0].name			
			this.image_preview = this.user.file.route
			
		}
	},
	computed: {
		schema() {

			let passwordValidation = yup.string();
			let passwordConfirmation = yup.string();
			
			if (!this.is_create) {
				passwordValidation = passwordValidation.notRequired();
				passwordConfirmation = passwordConfirmation.notRequired();
			}
			else {
				passwordValidation = yup.string().required();
				passwordConfirmation.oneOf([yup.ref('password'), null]).required()
			}


				return yup.object({
				number_id: yup.number().required(),
				name: yup.string().required(),
				last_name: yup.string().required(),
				email: yup.string().required().email(),
				password:passwordValidation,
				password_confirmation: passwordConfirmation ,
                role: yup.string().required(),
			});
		},
	},
	data() {
		return {
			is_create: true,
			user: {},
			role: null,
			back_errors: {},
			file: null,
			image_preview: '/storage/images/users/default.jpg',
		}
	},
	created() {
		this.index()
	},

	methods: {
		index() {},
		previewImage(event) {
			this.file = event.target.files[0]
            this.image_preview = URL.createObjectURL(this.file)
		},
		async Guardar() {
			try {
				this.user.role = this.role
				this.user.password_confirmation = this.user.password_confirmation 
				const user = this.createFormData(this.user)
				if(this.is_create) await axios.post('/users/store', user)
				else await axios.post(`/users/update/${this.user.id}`, user)
					await successMessage({ reload: true })
			} catch (error) {
				this.back_errors = await handlerErrors(error)
			}
		},
		createFormData(data){
			const form_data = new FormData()
			if(this.file)form_data.append('file', this.file, this.file.name )
			form_data.append('name', this.user.name)
			for (const prop in data) {
				form_data.append(prop, data[prop])
				
			}
			return form_data
		},
		
		reset(){
			this.is_create = true
			this.user = {}
			this.role = null
			this.$parent.user = {}
			this.back_errors
			this.file = null
			this.image_preview = '/storage/images/users/default.jpg'
			document.getElementById("file").value = ''
			setTimeout(() => this.$refs.Form.resetForm(), 100 )}
			

	}
}
</script>