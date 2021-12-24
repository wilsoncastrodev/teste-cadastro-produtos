import Login from '../views/Login.vue'
import Products from '../views/Products.vue'
import Tags from '../views/Tags.vue'
import Reports from '../views/Reports.vue'

export default {
  mode: 'history',
  routes: [
    {
      path: '/',
      redirect: '/produtos'
    },
    {
      path: '/login',
      name: 'Login',
      component: Login,
      meta: {guest: true}
    },
    {
      path: '/produtos',
      name: 'Products',
      component: Products,
      meta: {requiresAuth: true}
    },
    {
      path: '/tags',
      name: 'Tags',
      component: Tags,
      meta: {requiresAuth: true}
    },
    {
      path: '/relatorios',
      name: 'Reports',
      component: Reports,
      meta: {requiresAuth: true}
    },
  ]
}
