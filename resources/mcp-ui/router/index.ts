import { createMemoryHistory, createRouter } from 'vue-router'
import WeatherView from '@mcp/views/WeatherView.vue';
import DefaultView from '@mcp/views/DefaultView.vue';

const routes = [
    { path: '/', component: DefaultView, name: 'default' },
    { path: '/weather', component: WeatherView, name: 'weather' },
]

export const router = createRouter({
  history: createMemoryHistory(),
  routes,
})
