import { createMemoryHistory, createRouter } from 'vue-router'

import RootView from '@/pages/RootView.vue'
import AboutView from '@/pages/PerformanceView.vue'

const routes = [
  { path: '/', component: RootView, name: 'root' },
  { path: '/performance', component: AboutView, name: 'performance' },
]

export const router = createRouter({
  history: createMemoryHistory(),
  routes,
})
