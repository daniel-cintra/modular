import { createVueApp } from './create-vue-app.js'
import IndexExampleComponent from './Components/IndexExampleComponent.vue'

createVueApp({
    components: {
        IndexExampleComponent
    }
}).mount('#app')
