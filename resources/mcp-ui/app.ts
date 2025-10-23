import '@mcp/app.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import { router } from '@mcp/router'
import App from '@mcp/App.vue'

export const app = createApp(App)
    .use(router)
    .use(createPinia())
    .mount('#app');
