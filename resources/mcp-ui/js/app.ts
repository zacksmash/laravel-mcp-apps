import '../css/app.css'
import { createApp } from 'vue'
import { createPinia } from 'pinia'
// import { router } from '@/router'
import App from '@/App.vue'
import { SET_GLOBALS_EVENT_TYPE, SetGlobalsEvent } from './types/openai'

function waitForOpenAI() {
  return new Promise((resolve) => {
    if (window.openai) return resolve(true)

    const listener = (event: SetGlobalsEvent) => {
      if (event.type === SET_GLOBALS_EVENT_TYPE && event.detail?.globals) {
        window.removeEventListener(SET_GLOBALS_EVENT_TYPE, listener)
        resolve(true)
      }
    }

    window.addEventListener(SET_GLOBALS_EVENT_TYPE, listener)
  })
}

waitForOpenAI().then(() => {
    createApp(App)
        // .use(router)
        .use(createPinia())
        .mount('#app')
})
