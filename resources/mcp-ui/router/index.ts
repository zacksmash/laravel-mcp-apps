import { createMemoryHistory, createRouter } from 'vue-router'
import PerformanceView from '@mcp/views/PerformanceView.vue'

const routes = [
  { path: '/performance', component: PerformanceView },
]

export const router = createRouter({
  history: createMemoryHistory(),
  routes,
})
