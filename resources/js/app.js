require('./bootstrap');
window.Vue = require('vue').default;

import VueRouter from 'vue-router';
import routes from './routes/routes.js'
import { getToken } from './services/api';

Vue.use(VueRouter);

const router = new VueRouter(routes);

Vue.component('app', require('./App.vue').default);

router.beforeEach((to, from, next) => {
  const authenticated = getToken('token')

  if (to.matched.some(record => record.meta.requiresAuth)) {
      if (!authenticated) {
          next({ name: 'Login' })
      }
  }

  if(to.matched.some(record => record.meta.guest)) {
      if (authenticated) {
          next({ name: 'Products' })
      }
  }

  next()
});

const app = new Vue({
  el: '#app',
  router: router,
});
