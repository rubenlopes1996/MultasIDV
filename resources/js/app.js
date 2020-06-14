/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */
// eslint-disable-next-line no-unused-vars
import vue from 'vue';
import vuetify from './plugins/vuetify';
import VueRouter from 'vue-router';
import router from './routes.js';
import Vuetify from 'vuetify/lib';

require('./bootstrap');

window.Vue = require('vue');

Vue.use(Vuetify);
Vue.use(VueRouter);

Vue.component('dashboard', require('./dashboard.vue').default);
Vue.component('bar', require('./components/appBar.vue').default);

window.Event = new Vue();

// eslint-disable-next-line no-unused-vars
const app = new Vue({
  el: '#app',
  vuetify,
  router,
}).$mount('#app');
