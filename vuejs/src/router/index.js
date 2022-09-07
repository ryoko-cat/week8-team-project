import { createRouter, createWebHistory } from 'vue-router'
import RouterTestFirst from '@/components/RouterTestFirst.vue'
import RouterTestSecond from '@/components/RouterTestSecond.vue'
import RouterTestThird from '@/components/RouterTestThird.vue'
import RouterTestFourth from '@/components/RouterTestFourth.vue'
import SignUp from '@/components/SignUp.vue'

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
  },
  {
    path: '/signup',
    name: 'SignUp',
    component: SignUp
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router