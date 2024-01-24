import { createApp } from 'vue/dist/vue.esm-bundler.js'
import IndexExampleComponent from './components/IndexExampleComponent.vue'

//for static images
import.meta.glob(['../images/**'])

createApp({
    components: {
        IndexExampleComponent
    }
}).mount('#app')
