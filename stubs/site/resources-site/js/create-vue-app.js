import { createApp } from 'vue/dist/vue.esm-bundler.js'
//import commonComponents from './common-components.js'

export const createVueApp = (additionalComponents = {}) => {
    const app = createApp({
        components: {
            //...commonComponents,
            ...additionalComponents
        }
    })

    import.meta.glob(['../images/**'])

    return app
}
