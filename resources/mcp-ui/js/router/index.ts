import { createMemoryHistory, createRouter } from 'vue-router'

import AboutView from '@mcp/pages/PerformanceView.vue'

const routes = [
  { path: '/performance', component: AboutView, name: 'performance' },
]

export const router = createRouter({
  history: createMemoryHistory(),
  routes,
})
