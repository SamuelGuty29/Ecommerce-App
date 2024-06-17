import './bootstrap'
import { createApp } from 'vue'
import vSelect from 'vue-select'

// Components ---------------------------------------------------
import BackendError from '../components/Components/BackendError.vue'
import UserList from '../components/users/UserList.vue'
import ProductList from '../components/products/ProductList.vue'


const app = createApp({
	components: {
		UserList,
		ProductList
	}
})

app.component('v-select', vSelect)
app.component('backend-error', BackendError)
app.mount('#app')
