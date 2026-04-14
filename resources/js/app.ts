import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import type { DefineComponent } from 'vue'
import { createApp, h } from 'vue'
import '../css/app.css'
//import AuthLayout from './layouts/AuthLayout.vue'
//import UserLayout from './layouts/UserLayout.vue'
import { createApp, h } from 'vue'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel'

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./pages/**/*.vue')
    return pages[`./pages/${name}.vue`]()
  },
  setup({ el, App, props, plugin }) {
      createApp({ render: () => h(App, props) })
          .use(plugin)
          .mount(el)
  },
});