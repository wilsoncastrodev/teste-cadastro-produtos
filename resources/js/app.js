require('./bootstrap');
window.Vue = require('vue').default;

import VueRouter from 'vue-router';
import routes from './routes/routes.js'

Vue.use(VueRouter);

const router = new VueRouter(routes);

Vue.component('app', require('./App.vue').default);

const app = new Vue({
  el: '#app',
  router: router,
});
