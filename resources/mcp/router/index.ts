import WeatherView from '@mcp/views/weather/WeatherView.vue';
import { createMemoryHistory, createRouter } from 'vue-router';

const routes = [{ path: '/', component: WeatherView, name: 'weather' }];

export const router = createRouter({
    history: createMemoryHistory(),
    routes,
});
