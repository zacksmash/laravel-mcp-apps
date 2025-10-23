import '@mcp/app.css';

import App from '@mcp/App.vue';
import { router } from '@mcp/router';
import { createPinia } from 'pinia';
import { createApp } from 'vue';

export const app = createApp(App).use(router).use(createPinia()).mount('#app');
