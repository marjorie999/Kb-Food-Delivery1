import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import router from './router'
import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap"
import './assets/css/styles.css'
import './assets/js/scripts.js'

/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/* import specific icons */
import { faCartShopping, faTrash, faBagShopping, faCircleXmark, faCheckCircle} from '@fortawesome/free-solid-svg-icons'


/* add icons to the library */
library.add(faCartShopping,faTrash, faBagShopping, faCircleXmark, faCheckCircle)


const app = createApp(App)
 app
 .use(router)
 .component('font-awesome-icon', FontAwesomeIcon)
 .mount('#app')