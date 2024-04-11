import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import IcreativeView from '../views/IcreativeView.vue'
import JsonView from '../views/JsonView.vue'
import ProductsList from '../views/ProductsList.vue'
import ProductView from '../views/ProductView.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/icreative',
    name: 'ICreative',
    component: IcreativeView
  },
  {
    path: '/json',
    name: 'Json',
    component: JsonView
  },
  {
    path: '/products',
    name: 'Products',
    component: ProductsList
  },
  {
    path: '/product/:id',
    name: 'ProductView',
    component: ProductView
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
