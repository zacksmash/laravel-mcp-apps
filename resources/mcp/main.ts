import '@mcp/assets/main.css';

import { createPinia } from 'pinia';
import { createApp } from 'vue';

import OpenAiApp from '@mcp/OpenAiApp.vue';
import { router } from '@mcp/router';

const app = createApp(OpenAiApp);

app.use(createPinia());
app.use(router);

app.mount('#app');
