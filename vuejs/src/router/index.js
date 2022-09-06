import { createRouter, createWebHistory } from 'vue-router'
import RouterTestFirst from '@/components/RouterTestFirst.vue'
import RouterTestSecond from '@/components/RouterTestSecond.vue'
import RouterTestThird from '@/components/RouterTestThird.vue'
import RouterTestFourth from '@/components/RouterTestFourth.vue'


const routes = [
  {
    path: '/',
    name: 'routerTestFirst',
    component: RouterTestFirst
  },
  {
    path: '/second',
    name: 'routerTestSecond',
    component: RouterTestSecond
  },
  {
    path: '/third',
    name: 'routerTestThird',
    component: RouterTestThird
  },
  {
    path: '/fourth',
    name: 'routerTestFourth',
    component: RouterTestFourth
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router