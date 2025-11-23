import '@mcp/assets/main.css';

import { createPinia } from 'pinia';
import { createApp } from 'vue';

import OpenAIApp from '@mcp/OpenAIApp.vue';
import { router } from '@mcp/router';

const app = createApp(OpenAIApp);

app.use(createPinia());
app.use(router);

app.mount('#app');
