import '../css/app.css'
import { createApp } from 'vue'
// import { createPinia } from 'pinia'
// import { router } from '@/router'
import App from '@/App.vue'

export function mount(el: HTMLElement, props?: Record<string, unknown>) {
  createApp(App, props)
    // .use(router)
    // .use(createPinia())
    .mount(el)
}

const el = document.getElementById('app')
if (el) mount(el)
