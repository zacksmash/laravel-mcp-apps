import '@mcp/assets/main.css';

import { createPinia } from 'pinia';
import { createApp } from 'vue';

import App from '@mcp/App.vue';
import { router } from '@mcp/router';

const app = createApp(App);

app.use(createPinia());
app.use(router);

app.mount('#app');
