require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('app', require('./App.vue').default); 

const app = new Vue({
    el: '#app',
});
