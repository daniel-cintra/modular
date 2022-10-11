import './bootstrap'
import '../css/app.css'
import 'remixicon/fonts/remixicon.css'

//ui
// import 'primevue/resources/themes/tailwind-light/theme.css';
// import 'primevue/resources/themes/fluent-light/theme.css';
// import 'primevue/resources/primevue.min.css';
// import 'primeicons/primeicons.css';

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m'

const appName =
    window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel'

//ui
import PrimeVue from 'primevue/config'

// global components
// import { Inertia } from "@inertiajs/inertia";
import { Link } from '@inertiajs/inertia-vue3'
import Layout from './Layouts/AuthenticatedLayout.vue'

//these must be globally registered, not autoloaded...
import ToastService from 'primevue/toastservice'
import Toast from 'primevue/toast'
import ConfirmationService from 'primevue/confirmationservice'
import ConfirmDialog from 'primevue/confirmdialog'
import Tooltip from 'primevue/tooltip'

import AppBtnIcon from './Directives/AppBtnIcon'

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
        const page = resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue')
        )

        page.then((module) => {
            module.default.layout = module.default.layout || Layout
        })

        return page
    },
    setup({ el, app, props, plugin }) {
        // const meta = document.createElement("meta");
        // meta.name = "naive-ui-style";
        // document.head.appendChild(meta);

        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(PrimeVue)
            .use(ToastService)
            .use(ConfirmationService)
            .component('Toast', Toast)
            .component('ConfirmDialog', ConfirmDialog)
            .component('Link', Link)
            .directive('btnIcon', AppBtnIcon)
            .directive('tooltip', Tooltip)
            .mount(el)
    }
})

InertiaProgress.init({ color: '#33b7f7' })
