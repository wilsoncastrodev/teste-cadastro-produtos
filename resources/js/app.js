require('./bootstrap');
window.Vue = require('vue').default;

import VueRouter from 'vue-router';
import Vuetify from 'vuetify';
import routes from './routes/routes.js';
import { getToken } from './services/api';
import pt from 'vuetify/src/locale/pt.ts';

Vue.use(Vuetify);
Vue.use(VueRouter);

export default new Vuetify({
  lang: {
    locales: { pt },
    current: 'pt',
  },
})

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
  vuetify : new Vuetify(),
});
