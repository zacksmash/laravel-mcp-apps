import { createMemoryHistory, createRouter } from 'vue-router'

import RootView from '@/pages/RootView.vue'
import HomeView from '@/pages/HomeView.vue'
import AboutView from '@/pages/PerformanceView.vue'

const routes = [
  { path: '/', component: RootView, name: 'root' },
  { path: '/home', component: HomeView, name: 'home' },
  { path: '/about', component: AboutView, name: 'about' },
]

export const router = createRouter({
  history: createMemoryHistory(),
  routes,
})
