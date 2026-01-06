import '../css/app.css'
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
//import {Select2Vue3} from 'select2-vue3'
//import 'select2-vue3/dist/select2-vue3.css'

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
           // .use('Select2Vue3', Select2Vue3)
            .mount(el)
    },
})
